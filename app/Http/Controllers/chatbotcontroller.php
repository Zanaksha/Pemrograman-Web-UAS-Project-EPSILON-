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
        $history = session('chat_history', []);

        [$updatedHistory, $reply] = $chat->chat($history, trim($request->message));

        session(['chat_history' => $updatedHistory]);

        return response()->json(['reply' => $reply]);
    }
}