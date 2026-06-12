<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'email'        => 'required|email',
            'phone'        => 'required|string|max:20',
            'inquiry_type' => 'required|string',
            'message'      => 'required|string',
        ]);

        Message::create($request->all());

        return back()->with('success', 'Pesan berhasil dikirim! Tim kami akan menghubungi kamu segera.');
    }
}