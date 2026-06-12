<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot.index');
    }

    public function send(Request $request)
    {
        $message = strtolower($request->message);

        $chat = ChatbotResponse::whereRaw(
            'LOWER(?) LIKE CONCAT("%", LOWER(keyword), "%")',
            [$message]
        )->first();

        return response()->json([
            'reply' => $chat
                ? $chat->response
                : 'Maaf, saya belum menemukan jawaban.'
        ]);
    }
}