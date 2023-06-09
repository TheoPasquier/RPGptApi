<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request){
        $headers = $request->header();
        $method = $request->method();

        return response()->json([
        'headers' => $headers,
        'method' => $method,
        ]);
    }

    public function reverse(Request $request){
        $payload = $request->json()->all();
        
        if (isset($payload['message'])) {
            $reversedMessage = strrev($payload['message']);
        } else {
            $reversedMessage = '';
        }
        
        return response()->json([
            'reversedMessage' => $reversedMessage,
        ]);

    }
}
