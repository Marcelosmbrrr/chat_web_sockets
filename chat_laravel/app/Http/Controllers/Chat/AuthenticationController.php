<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (Auth::attempt(["username" => $request->email, "password" => $request->password])) {

            $request->session()->regenerate();

            return response(["message" => "Login successful!"], 200);
        } else {

            return response(["message" => "Invalid credentials!"], 500);
        }
    }
}
