<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\{
    SendMessageController,
    AuthenticationController
};

Route::get('/', function () {
    return view('index');
});

Route::post("/login", AuthenticationController::class);
Route::post("/send-message", SendMessageController::class);
