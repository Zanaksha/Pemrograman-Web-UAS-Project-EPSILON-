@extends('layouts.mainlayout')
@section('title','Choose & Buy')
@section('content')

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css"/>

<style>
    body { background: #f5f5f5; }
    .shop-title { font-size: 60px; font-weight: bold; }
    .product-card { border: none; overflow: hidden; transition: 0.4s; cursor: pointer; }
    .product-card:hover { transform: translateY(-10px); }
    .product-card img { height: 300px; object-fit: cover; transition: 0.4s; }
    .product-card:hover img { transform: scale(1.05); }
</style>

<div style="height: 80px;"></div>

<section class="container py-5 text-center">
    <h1 class="shop-title mb-3">OUR SHOP</h1>
    <p class="text-secondary">Discover premium collection products</p>
</section>

<section class="container pb-5">
    <div class="row g-4">
        @forelse($products as $i => $product)
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
            <div class="card product-card shadow-sm"
                 onclick="window.location.href='/produk-detail?produk={{ strtolower(str_replace(' ', '-', $product->name)) }}'">
                <img src="{{ $product->image }}" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">{{ $product->name }}</h4>
                    <p class="text-secondary">{{ $product->description }}</p>
                    <h5 class="fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                    @if($product->stock <= 0)
                        <span class="badge bg-danger">Stok Habis</span>
                    @elseif($product->stock <= 5)
                        <span class="badge bg-warning text-dark">Stok Terbatas: {{ $product->stock }}</span>
                    @else
                        <span class="badge bg-success">Stok: {{ $product->stock }}</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada produk tersedia.</p>
        </div>
        @endforelse
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000 });
</script>

@endsection