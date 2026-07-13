<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OllamaChatService;

class ChatbotController extends Controller
{
    protected const MAX_DISPLAY_MESSAGES = 50;

    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request, OllamaChatService $chat)
    {
        $userMessage = trim($request->input('message', ''));

        if ($userMessage === '') {
            return response()->json(['reply' => 'Pesan tidak boleh kosong.'], 422);
        }

        $history = session('chat_history', []);

        [$updatedHistory, $reply] = $chat->chat($history, $userMessage);

        session(['chat_history' => $updatedHistory]);

        $displayHistory = session('chat_display_history', []);
        $displayHistory[] = ['role' => 'user', 'text' => $userMessage];
        $displayHistory[] = ['role' => 'bot', 'text' => $reply];

        $displayHistory = array_slice($displayHistory, -self::MAX_DISPLAY_MESSAGES);

        session(['chat_display_history' => $displayHistory]);

        return response()->json(['reply' => $reply]);
    }

    public function history()
    {
        return response()->json([
            'history' => session('chat_display_history', []),
        ]);
    }

    public function reset(Request $request)
    {
        session()->forget(['chat_history', 'chat_display_history']);
        return response()->json(['status' => 'ok']);
    }
}