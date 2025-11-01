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
            $prompt = "You are a specialized content headline generator. Provide the single best, catchy blog article title about: " . $topic . " in 20 words or less. **Title only.**";

            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $gemini_api_key;

            $response = Http::post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt]]]
                ]
            ]);

            if ($response->failed()) {
                return response()->json($response->body(), $response->code());
            }

            $data = $response->json();

            $title = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Generated Title (Fallback)';
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['title' => trim($title)]);
    }
}
