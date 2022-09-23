<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\Message;
use Illuminate\Support\Facades\Auth;

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
        event(new Message($request->message));

        return response([
            "username" => Auth::user()->username
        ], 200);
    }
}
