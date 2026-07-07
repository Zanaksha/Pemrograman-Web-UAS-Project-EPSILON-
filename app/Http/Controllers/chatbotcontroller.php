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
        $userMessage = trim($request->message);

        [$updatedHistory, $reply] = $chat->chat($history, $userMessage);

        session(['chat_history' => $updatedHistory]);

        // simpan versi bersih buat ditampilkan lagi nanti
        $displayHistory = session('chat_display_history', []);
        $displayHistory[] = ['role' => 'user', 'text' => $userMessage];
        $displayHistory[] = ['role' => 'bot', 'text' => $reply];
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