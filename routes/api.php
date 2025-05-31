<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FriendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

// Route::middleware('auth:sanctum')->get('/friends', [FriendController::class, 'index']);
Route::middleware('auth:sanctum')->get('/friends', function (Request $request) {
    return $request->user()->friends; // Adjust based on your relationship
});

?>