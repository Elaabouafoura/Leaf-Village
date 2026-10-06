<?php

namespace App\Observers;

use App\Models\Partenaire;
use Twilio\Rest\Client;

class PartenaireObserver
{
    public function created(Partenaire $partenaire)
    {
        try {
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $twilio = new Client($sid, $token);

            $message = "Good morning {$partenaire->nom},Thank you for joining Leaf Village as a partner ({$partenaire->type}). 🌿";

            $twilio->messages->create(
                $partenaire->contact, // le numéro de téléphone
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => $message
                ]
            );

            \Log::info("✅ SMS envoyé à {$partenaire->contact}");
        } catch (\Exception $e) {
            \Log::error("❌ Erreur d'envoi SMS Twilio : " . $e->getMessage());
        }
    }
}
