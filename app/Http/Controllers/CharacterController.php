<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request\Validated;
use Illuminate\Http\Request;
use League\CommonMark\Environment\Environment;

class CharacterController extends Controller
{
    // public function sendCharacter(Request $request){
    //     $payload = $request->json()->all();
    //     $p_data_env = ['id' => $payload['env'][0]['id'], 'environement' => $payload['env'][0]['environement']];
    //     $p_data_charac = ['id' => $payload['character'][0]['id'], 'name'=>$payload['character'][0]['name']];

    //     $environement = new Environment($p_data_env['id'],$p_data_env['environement']);
    //     $character = new Character($p_data_charac['id'],$p_data_charac['name']);

    //     return response()->json([
    //             'personality' => $character->name,
    //         ]);

    // }

    public function createCharacter(Request $request){
        $token = $request->query('token');

        /***
         * 
         */
        $payload_verification = $request->validate([
                'name' => 'required|max:255',
                'environment' => 'required|max:255'
            ]);

        return response()->json([
            'response' => 'Personnage créé',
            'token' => $token
        ]);



    }
}
