<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\openAiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/testapi", [TestController::class, "test"]);
Route::post("/reverse", [TestController::class, "reverse"])->middleware('auth:sanctum');

Route::post("/openai", [openAiController::class, "whatHappenedAt"]);
Route::post("/character", [CharacterController::class, "createCharacter"]);


//Users routes
Route::post("/user/login", [UserController::class, "login"]);
Route::post("/user/register", [UserController::class, "register"]);
Route::put("/user/edit/{user_id}", [UserController::class, "edit"])->middleware('auth:sanctum');
Route::delete("/user/delete/{user_id}", [UserController::class, "delete"])->middleware('auth:sanctum');


//Conversation routes
Route::post("/conversation/{user_id}/create",[ConversationController::class, "create"])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
