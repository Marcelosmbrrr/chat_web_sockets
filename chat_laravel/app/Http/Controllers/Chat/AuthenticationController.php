<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// Broadcast event
use App\Events\Authenticated as SuccessfulLoginEvent;

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
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {

            $request->session()->regenerate();

            $user = User::findOrFail(Auth::user()->id);

            // Event that will execute a server-side emission
            // Successful login event emission
            event(new SuccessfulLoginEvent($user));

            return response(["message" => "Login successful!"], 200);
        } else {
            return response(["message" => "Invalid credentials!"], 500);
        }
    }
}
