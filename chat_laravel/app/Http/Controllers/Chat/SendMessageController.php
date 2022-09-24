<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Broadcast event
use App\Events\Message as SendMessageEvent;

class SendMessageController extends Controller
{
    /**
     * Handle the incoming request.
     * Emissions from client-side detection.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   
         // Event that will execute a server-side emission
        // Successful send message event emission
        event(new SendMessageEvent($request->message));

        return response([
            "username" => Auth::user()->username
        ], 200);
    }
}
