@extends('layouts.mainlayout')
@section('title', 'Search Results')
@section('content')

<div style="height: 80px;"></div>

<style>
    .search-page {
        background: #f5f5f5;
        min-height: 100vh;
        padding: 40px 0 80px;
    }

    .search-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 32px;
    }

    .search-header {
        margin-bottom: 36px;
    }

    .search-header h2 {
        font-size: 22px;
        font-weight: 600;
        color: #111;
    }

    .search-header h2 span {
        color: #0066cc;
    }

    .search-header p {
        color: #999;
        font-size: 13px;
        margin-top: 6px;
    }

    .section-block {
        margin-bottom: 48px;
    }

    .section-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #aaa;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .section-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e5e5e5;
    }

    .section-label .count-badge {
        font-size: 11px;
        font-weight: 600;
        color: #0066cc;
        background: #e8f0fb;
        padding: 2px 9px;
        border-radius: 20px;
        letter-spacing: 0;
    }

    .result-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .result-card {
        background: white;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        cursor: pointer;
        transition: border-color 0.2s ease, transform 0.15s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .result-card:hover {
        border-color: rgba(0,0,0,0.16);
        transform: translateY(-3px);
        color: inherit;
        text-decoration: none;
    }

    .card-img-wrap {
        position: relative;
        width: 100%;
        height: 140px;
        background: #f8f8f8;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
    }

    .card-drivetrain-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 10px;
        font-weight: 600;
        color: #0066cc;
        background: #e8f0fb;
        padding: 3px 9px;
        border-radius: 20px;
    }

    .card-body {
        padding: 14px 16px 16px;
    }

    .card-name {
        font-size: 15px;
        font-weight: 700;
        color: #111;
        margin-bottom: 3px;
    }

    .card-cat {
        font-size: 12px;
        color: #bbb;
    }

    .card-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 10px 0;
    }

    .card-price {
        font-size: 13px;
        font-weight: 600;
        color: #0066cc;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #bbb;
    }

    .empty-state .empty-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .empty-state h4 {
        font-size: 18px;
        font-weight: 600;
        color: #888;
        margin-bottom: 8px;
    }

    .empty-state p {
        font-size: 14px;
    }

    @media (max-width: 992px) {
        .result-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 768px) {
        .result-grid { grid-template-columns: repeat(2, 1fr); }
        .search-container { padding: 0 20px; }
    }

    @media (max-width: 480px) {
        .result-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="search-page" style="margin-top: 80px;">
    <div class="search-container">

        <div class="search-header">
            <h2>Search Results for <span>"{{ $query }}"</span></h2>
            <p>{{ $cars->count() + $products->count() }} results found</p>
        </div>

        @if($cars->count() === 0 && $products->count() === 0)
            <div class="empty-state">
                <div class="empty-icon">🔍</div>
                <h4>No results found</h4>
                <p>Try searching with different keywords.</p>
            </div>
        @else

            @if($cars->count() > 0)
            <div class="section-block">
                <div class="section-label">
                    Cars <span class="count-badge">{{ $cars->count() }}</span>
                </div>
                <div class="result-grid">
                    @foreach($cars as $car)
                    <a href="/{{ $car->slug }}" class="result-card">
                        <div class="card-img-wrap">
                            @if($car->drivetrain)
                                <span class="card-drivetrain-badge">{{ $car->drivetrain }}</span>
                            @endif
                            @if(str_starts_with($car->image, 'http'))
                                <img src="{{ $car->image }}" alt="{{ $car->name }}">
                            @else
                                <img src="{{ asset('images/' . basename($car->image)) }}" alt="{{ $car->name }}">
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="card-name">{{ $car->name }}</div>
                            <div class="card-cat">{{ $car->category }}</div>
                            @if($car->price)
                                <div class="card-divider"></div>
                                <div class="card-price">Rp {{ number_format($car->price, 0, ',', '.') }}</div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($products->count() > 0)
            <div class="section-block">
                <div class="section-label">
                    Products <span class="count-badge">{{ $products->count() }}</span>
                </div>
                <div class="result-grid">
                    @foreach($products as $product)
                    <a href="/detail?produk={{ strtolower(str_replace(' ', '-', $product->name)) }}" class="result-card">
                        <div class="card-img-wrap">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <div class="card-name">{{ $product->name }}</div>
                            <div class="card-cat">{{ $product->category }}</div>
                            <div class="card-divider"></div>
                            <div class="card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        @endif

    </div>
</div>

@endsection