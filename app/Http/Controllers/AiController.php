<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function generateTitle(Request $request)
    {
        try {
            $gemini_api_key = config('app.gemini_api_key');

            if (!$gemini_api_key) {
                return response()->json(['error' => [
                    'message' => 'Gemini API key not configured'
                ]], 500);
            }

            $request->validate([
                'topic' => 'nullable|string|max:255',
            ]);

            $topic = $request->topic ?: "the latest trending topic in the world";
            $prompt_title = "You are a specialized content headline generator. Provide the single best, catchy blog article title about: " . $topic . " in 20 words or less. **Title only.**";
            $prompt_description = "You are a specialized content headline generator. Provide the single best, catchy blog article short description about: " . $topic . ". **Description only.**";

            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $gemini_api_key;

            $response_title = Http::post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt_title]]]
                ]
            ]);

            $response_description = Http::post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt_description]]]
                ]
            ]);

            if ($response_title->failed()) {
                return response()->json($response_title->body(), $response_title->code());
            }

            if ($response_description->failed()) {
                return response()->json($response_description->body(), $response_description->code());
            }

            $data_title = $response_title->json();
            $data_description = $response_description->json();

            $title = $data_title['candidates'][0]['content']['parts'][0]['text'] ?? 'Generated Title (Fallback)';
            $description = $data_description['candidates'][0]['content']['parts'][0]['text'] ?? 'Generated Description (Fallback)';
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['title' => trim($title), 'description' => trim($description)]);
    }
}
