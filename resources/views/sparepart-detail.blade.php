@extends('layouts.mainlayout')
@section('title', $sparepart->name)
@section('content')

<div style="height: 80px;"></div>

<style>
    .detail-wrap { max-width: 1000px; margin: 0 auto; padding: 30px 20px 60px; }
    .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; }
    .detail-grid img { width: 100%; border-radius: 12px; height: 350px; object-fit: cover; }
    .badge-cat { background: #f0f0f0; padding: 4px 12px; border-radius: 20px; font-size: 12px; color: #666; }
    .price-big { font-size: 32px; font-weight: 700; color: #0066cc; margin: 14px 0; }
    .spec-box { background: white; border-radius: 10px; padding: 18px; margin-top: 16px; }
    .spec-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
    .spec-row:last-child { border: none; }
    .btn-order { display: block; width: 100%; padding: 14px; background: #111; color: white; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; margin-top: 20px; }
    .btn-order:hover { background: #0066cc; color: white; }
</style>

<div class="detail-wrap">
    <div class="detail-grid">
        <img src="{{ $sparepart->image }}" alt="{{ $sparepart->name }}">
        <div>
            <span class="badge-cat">{{ $sparepart->category }}</span>
            <h1 style="margin-top:10px;">{{ $sparepart->name }}</h1>
            <p style="color:#888;">{{ $sparepart->description }}</p>
            <div class="price-big">Rp {{ number_format($sparepart->price, 0, ',', '.') }}</div>

            <div class="spec-box">
                <div class="spec-row"><span>Part Number</span><strong>{{ $sparepart->part_number }}</strong></div>
                <div class="spec-row"><span>Compatible With</span><strong>{{ $sparepart->compatible_model ?? 'All Models' }}</strong></div>
                <div class="spec-row"><span>Stock Available</span><strong>{{ $sparepart->stock }} units</strong></div>
            </div>
                <a href="/beli?model={{ urlencode($sparepart->name) }}&harga=Rp+{{ number_format($sparepart->price, 0, ',', '.') }}&skip=1" class="btn-order">Order Now →</a>
        </div>
    </div>
</div>

@endsection