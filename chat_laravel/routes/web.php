<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\SendMessageController;

Route::get('/', function () {
    return view('index');
});

Route::post("/send-message", SendMessageController::class);
