<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SustainabilityAIService
{
    protected static $model = "gpt-4o-mini"; // ou "gpt-4o" si tu veux plus de précision

    /**
     * Analyze a resource using OpenAI
     */
    public static function analyzeRessource($name, $type)
    {
        $prompt = "Analyze the sustainability of the resource: \"$name\" (type: \"$type\").
        Respond ONLY in strict JSON format:
        {
            \"material\": \"...\", 
            \"co2_impact\": number (0–10), 
            \"eco_alternative\": \"...\"
        }";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('OPENAI_API_BASE', 'https://api.openai.com') . '/v1/chat/completions', [
                'model' => self::$model,
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a sustainability analysis assistant.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.2,
            ]);

            if ($response->successful()) {
                $content = $response->json()['choices'][0]['message']['content'] ?? null;

                if ($content) {
                    $data = json_decode($content, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return [
                            'material' => $data['material'] ?? 'unknown',
                            'co2_impact' => $data['co2_impact'] ?? null,
                            'eco_alternative' => $data['eco_alternative'] ?? null,
                        ];
                    }
                }
            } else {
                Log::error("OpenAI API error: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("SustainabilityAIService exception: " . $e->getMessage());
        }

        // Valeurs par défaut si erreur
        return [
            'material' => 'unknown',
            'co2_impact' => null,
            'eco_alternative' => null,
        ];
    }
}
