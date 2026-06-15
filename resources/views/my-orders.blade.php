@extends('layouts.mainlayout')
@section('title', 'Pesanan Saya')
@section('content')

<div style="height: 80px;"></div>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">Pesanan Saya</h2>

    @forelse($orders as $order)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="fw-bold mb-0">{{ $order->model }}</h5>
                <span class="badge 
                    {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                    {{ $order->status == 'confirmed' ? 'bg-success' : '' }}
                    {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}"
                    style="font-size:14px; padding: 8px 16px;">
                    {{ strtoupper($order->status) }}
                </span>
            </div>
            <p class="mb-1 text-muted">Order ID: <strong>{{ $order->order_id }}</strong></p>
            <p class="mb-1 text-muted">Warna: {{ $order->warna }}</p>
            <p class="mb-1 text-muted">Harga: <strong>Rp {{ number_format($order->harga, 0, ',', '.') }}</strong></p>
            <p class="mb-0 text-muted">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</p>

         @if($order->status == 'confirmed')
<div class="alert alert-success mt-3 mb-0">
    ✅ Pesanan kamu telah dikonfirmasi! Tim kami akan segera menghubungi kamu.
    @php $warranty = $warranties->get($order->model) ?? $warranties->get('BMW ' . $order->model) ?? null; @endphp
    @if($warranty)
    <div class="mt-2 p-2" style="background:rgba(255,255,255,0.5); border-radius:8px;">
        🛡️ <strong>VIN Number:</strong> 
        <span style="font-family:monospace; letter-spacing:2px; font-size:16px;">{{ $warranty->vin }}</span>
        <br><small>Warranty berlaku hingga: <strong>{{ \Carbon\Carbon::parse($warranty->warranty_end)->format('d M Y') }}</strong></small>
    </div>
    @endif
</div>
@elseif($order->status == 'cancelled')
<div class="alert alert-danger mt-3 mb-0">
    ❌ Pesanan kamu dibatalkan. Silakan hubungi kami untuk informasi lebih lanjut.
</div>
@else
<div class="alert alert-warning mt-3 mb-0">
    ⏳ Pesanan kamu sedang diproses. Mohon tunggu konfirmasi dari tim kami.
</div>
@endif  
        </div>
        </div>
    @empty
    <div class="text-center py-5">
        <p class="text-muted">Belum ada pesanan.</p>
        <a href="/buycar" class="btn btn-primary">Beli Sekarang</a>
    </div>
    @endforelse
</div>

@endsection