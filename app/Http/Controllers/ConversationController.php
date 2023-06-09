<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConversationController extends Controller
{
    public function create(Request $request, $user_id){

        try {
            $user = User::find($user_id);
    
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            $this->authorize('update', $user);

            $payload_verification = $request->validate([
                'name' => 'required|min:3|max:255',
            ]);

            $conversation = $user->createConversation($payload_verification['name']);
            return response()->json([
                'message' => 'Conversation created.'
            ],200);


        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

    }

    public function delete(Request $request, $user_id){
        try {
            $user = User::find($user_id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            
            
            $this->authorize('update', $user);
            
            $payload_verification = $request->validate([
                'confirmation'=> 'required|boolean'
            ]);
            
            
            if ($payload_verification['confirmation']) {
                $conversation = Conversation::where('user_id', $user_id)->first();
                $conversation->delete();
                return response()->json([
                    'message' => 'User deleted',
                     'user' => $user
                 ], 200);
                }else{
                    return response()->json([
                        'message' => 'Cancelled action : User not deleted',
                        'user' => $user
                    ], 200);

                }


        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

    }
}
