<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Silakan login terlebih dahulu!', 'redirect' => '/login'], 401);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => 'BMW-' . time(),
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'kota' => $request->kota,
            'model' => $request->model,
            'warna' => $request->warna,
            'harga' => $request->harga,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order->order_id
        ]);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        
        // Update last_seen saat user buka halaman ini
        Auth::user()->update(['last_seen' => now()]);
        
        return view('my-orders', compact('orders'));
    }
    
}