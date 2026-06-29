@extends('layouts.mainlayout')
@section('title', 'Genuine Parts')
@section('content')

<div style="height: 80px;"></div>

<style>
    body { background: #f5f5f5; }
    .sp-wrap { max-width: 1200px; margin: 0 auto; padding: 30px 20px 60px; }
    .sp-header { text-align: center; margin-bottom: 30px; }
    .sp-header h1 { font-size: 42px; font-weight: 700; }
    .sp-header p { color: #888; }

    .filter-row { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; margin-bottom: 30px; }
    .filter-chip {
        padding: 8px 18px; border: 1.5px solid #ddd; border-radius: 20px;
        text-decoration: none; color: #555; font-size: 13px; transition: 0.2s;
    }
    .filter-chip:hover, .filter-chip.active { background: #0066cc; border-color: #0066cc; color: white; }

    .sp-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .sp-card {
        background: white; border-radius: 12px; overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06); transition: 0.2s;
    }
    .sp-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
    .sp-card img { width: 100%; height: 200px; object-fit: cover; }
    .sp-card .body { padding: 18px; }
    .sp-card .cat-badge {
        display: inline-block; background: #f0f0f0; font-size: 11px;
        padding: 3px 10px; border-radius: 20px; color: #666; margin-bottom: 8px;
    }
    .sp-card h4 { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
    .sp-card .part-no { font-size: 12px; color: #999; margin-bottom: 8px; }
    .sp-card .compat { font-size: 12px; color: #0066cc; margin-bottom: 10px; }
    .sp-card .price { font-size: 18px; font-weight: 700; color: #111; }
    .sp-card .stock { font-size: 12px; color: #999; margin-top: 4px; }
    .btn-buy {
        display: block; width: 100%; padding: 10px; margin-top: 12px;
        background: #111; color: white; text-align: center; border-radius: 8px;
        text-decoration: none; font-size: 13px; font-weight: 600;
    }
    .btn-buy:hover { background: #0066cc; color: white; }

    @media (max-width: 768px) { .sp-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<div class="sp-wrap">
    <div class="sp-header">
        <h1>Genuine BMW Parts</h1>
        <p>Original parts engineered for performance, safety, and longevity.</p>
    </div>

    <div class="filter-row">
        <a href="/spareparts" class="filter-chip {{ !request('category') ? 'active' : '' }}">All</a>
        @foreach(['Engine','Brake','Filter','Electrical'] as $cat)
        <a href="/spareparts?category={{ $cat }}" class="filter-chip {{ request('category') == $cat ? 'active' : '' }}">{{ $cat }}</a>
        @endforeach
    </div>

    <div class="sp-grid">
        @forelse($spareparts as $part)
        <div class="sp-card">
            <img src="{{ $part->image }}" alt="{{ $part->name }}">
            <div class="body">
                <span class="cat-badge">{{ $part->category }}</span>
                <h4>{{ $part->name }}</h4>
                <div class="part-no">Part No: {{ $part->part_number }}</div>
                @if($part->compatible_model)
                <div class="compat">Fits: {{ $part->compatible_model }}</div>
                @endif
                <div class="price">Rp {{ number_format($part->price, 0, ',', '.') }}</div>
                <div class="stock">Stock: {{ $part->stock }} units</div>
                <a href="/spareparts/{{ $part->id }}" class="btn-buy">View Details</a>
            </div>
        </div>
        @empty
        <p style="text-align:center; color:#999; grid-column: span 3;">No spareparts found.</p>
        @endforelse
    </div>
</div>

@endsection