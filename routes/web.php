<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});



Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// where loggedun user can search any other user
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

// where logged user can his data
Route::get('/dashboard', function () {
    $user = Auth::user(); // Get logged-in user
    return view('dashboard', compact('user'));
})->middleware('auth');

// if user send friend request to other
Route::post('/friend-request/{id}', [UserController::class, 'sendFriendRequest'])->name('friend.request')->middleware('auth');

//simple logout functioanlity
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// if user see friend request pending coming from other and if another user accept that friend request
Route::middleware('auth')->group(function () {
    Route::get('/friend-requests', [UserController::class, 'pendingRequests'])->name('friend.requests.pending');
    Route::post('/friend-requests/accept/{id}', [UserController::class, 'acceptRequest'])->name('friend.request.accept');
});

//if loggedin user to any another profile account
Route::middleware('auth')->get('/profile/{id}', [UserController::class, 'viewProfile'])->name('profile.view');
//public url for privacy policy for facebook
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
