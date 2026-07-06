<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OllamaChatService;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request, OllamaChatService $chat)
    {
        $reply = $chat->chat(trim($request->message));

        return response()->json(['reply' => $reply]);
    }
}