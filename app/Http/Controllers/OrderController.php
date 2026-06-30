<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {   
        \Log::info('Request data:', $request->all());
        if (!Auth::check()) {
            return response()->json(['error' => 'Silakan login terlebih dahulu!', 'redirect' => '/login'], 401);
        }

        $order = Order::create([
        'user_id'    => Auth::id(),
        'order_id'   => 'BMW-' . strtoupper(uniqid()),
        'nama'       => $request->nama,
        'email'      => $request->email,
        'phone'      => $request->telp,
        'kota'       => $request->kota,
        'ktp'        => $request->ktp,
        'warna'      => $request->warna,
        'size'       => $request->size,
        'model'      => $request->model,
        'harga' => preg_replace('/[^0-9]/', '', $request->harga),
        'pembayaran' => $request->pembayaran,
        'type'       => $request->type ?? 'car',
        'status'     => 'pending',
    ]);

        return response()->json([
            'success'  => true,
            'order_id' => $order->order_id,
        ]);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $warranties = \App\Models\Warranty::where('owner_email', Auth::user()->email)->get()->keyBy('car_model');
        Auth::user()->update(['last_seen' => now()]);
        return view('my-orders', compact('orders', 'warranties'));
    }
}