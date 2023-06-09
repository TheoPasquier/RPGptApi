<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * JSON Format
     * {
     *      "email" : "",
     *      "password" : ""
     * }
     */
    public function register(Request $request)
    {
        try {
            $payload_verification = $request->validate([
                'username' => 'required|min:3|max:20',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8'
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'email' => $payload_verification['email'],
                'name' => $payload_verification['username'],
                'password' => Hash::make($payload_verification['password'])
            ]);

            // Renvoi de la réponse avec le token
            return response()->json([
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            $payload_verification = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|min:8'
            ]);

            $user = User::where('email', $payload_verification['email'])->first();

            if (!$user || !Hash::check($payload_verification['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid authentification',
                ], 401);
            }

            $token = $user->createToken('apitoken')->plainTextToken;


            return response()->json([
                'user' => $user,
                'token' => $token,
                'token expiration' => "3 days"
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);

        }
    }

    public function edit(Request $request, $user_id)
    {
        try {

            $user = User::find($user_id);
    
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                ], 404);
            }

            $this->authorize('update', $user);

            $payload_verification = $request->validate([
                'username' => 'min:3|max:20',
                'email' => 'email|max:255|unique:users',
                'password' => 'min:8'
            ]);
    
            if (!empty($payload_verification['username'])) {
                $user->name = $payload_verification['username'];
            }
        
            if (!empty($payload_verification['password'])) {
                $user->password = bcrypt($payload_verification['password']);
            }
        
            // Sauvegarder les modifications
            $user->save();
    
            return response()->json([
                'message' => 'User updated successfully',
                'user' => $user
            ], 200);
    
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
                 $user->delete();
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
