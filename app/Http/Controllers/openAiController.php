<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class openAiController extends Controller
{
    public function whatHappenedAt(Request $request){
        $payload = $request->json()->all();
        $historyDate = $payload['historyDate'];
        $client = new Client();
        $url = 'https://api.openai.com/v1/completions';
        $params = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_SECRET_KEY'),
            ],
            'json' => [
                'prompt' => "Que s'est-il passé d'important à la date : {$historyDate} ?",
                'model' => 'text-ada-001',
                'temperature' => 0.5,
                'max_tokens' => 100,
                'stop' => ['\n']
            ]
        ];

        $response = $client->post($url, $params);
        $responseBody = json_decode($response->getBody(), true);
        return response()->json([
            'message' => $responseBody['choices'][0]['text']
        ]);
    }
}
