<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplierAIEmail;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Log;

class AIMessageController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'fournisseur_id' => 'required|integer',
            'send_email' => 'nullable|boolean',
        ]);

        $fournisseur = Fournisseur::find($validated['fournisseur_id']);

        if (!$fournisseur) {
            return response()->json(['error' => 'Fournisseur introuvable'], 404);
        }

        // ✅ Nouveau prompt : emails finalisés, sans placeholders
        $prompt = match ($validated['type']) {
            'price_request' => "Rédige un email professionnel en français adressé à {$fournisseur->nom}, demandant poliment la grille tarifaire mise à jour pour ses produits. L'email doit être fluide, poli et prêt à être envoyé, sans aucun texte entre crochets ni champ à compléter.",
            
            'follow_up' => "Rédige un email de relance courtois et professionnel en français à {$fournisseur->nom}, concernant une commande récente. Remercie pour la collaboration et demande poliment une mise à jour sur l'état de la commande. L'email doit être complet et prêt à envoyer, sans mention du type [Votre Nom] ou [Votre Entreprise].",
            
            'product_inquiry' => "Rédige un email formel et clair en français à {$fournisseur->nom}, pour demander des détails sur les produits disponibles, la disponibilité, les conditions de livraison et les tarifs. L'email doit être immédiatement prêt à envoyer, sans texte entre crochets ni zone à compléter.",
            
            default => "Rédige un email professionnel en français à {$fournisseur->nom}. Il doit être complet et prêt à envoyer, sans texte entre crochets, et avec une signature appropriée.",
        };

        try {
            $response = Http::withToken(config('services.openai.key'))
                ->timeout(15)
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "Tu es un assistant expert en rédaction d'emails professionnels en français.
                            Règles :
                            - Ne jamais utiliser de texte entre crochets (ex: [Nom du destinataire], [Votre Nom], [Votre Entreprise]).
                            - Ne jamais ajouter de parties à compléter.
                            - Rédige toujours un email complet, fluide et professionnel, directement prêt à envoyer.
                            - Ne mettez pas une signature professionnelle .
                            "
                        ],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 250,
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API Error', ['response' => $response->body()]);
                return response()->json(['message' => 'Erreur lors de la génération de l’email par l’IA.'], 500);
            }

            $message = trim($response->json('choices.0.message.content', ''));

            if (!$message) {
                return response()->json(['message' => 'L’IA n’a pas renvoyé de contenu.'], 500);
            }

           

            $sent = false;
            if ($request->boolean('send_email') && $fournisseur->contact) {
                try {
                    Mail::to($fournisseur->contact)
                        ->send(new SupplierAIEmail('Message automatique de GreenSpaces', $message));
                    $sent = true;
                } catch (\Exception $e) {
                    Log::error('Email sending failed', [
                        'fournisseur' => $fournisseur->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'message' => $message,
                'sent' => $sent,
                'contact' => $fournisseur->contact ?? null,
            ]);

        } catch (\Exception $e) {
            Log::error('AI generation failed', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'Une erreur est survenue lors de la génération de l’email.',
                'sent' => false
            ], 500);
        }
    }
}
