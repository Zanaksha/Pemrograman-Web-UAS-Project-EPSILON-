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

        <div class="col-md-3" data-aos="fade-up">
            <div class="card product-card shadow-sm" onclick="window.location.href='/sneakers'">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">Sneakers</h4>
                    <p class="text-secondary">Modern lifestyle shoes</p>
                    <h5 class="fw-bold">1.200.000</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card product-card shadow-sm" onclick="window.location.href='/hoodie'">
                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1000" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">Hoodie</h4>
                    <p class="text-secondary">Casual fashion style</p>
                    <h5 class="fw-bold">90.000</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="card product-card shadow-sm" onclick="window.location.href='/watch'">
                <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1000" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">Watch</h4>
                    <p class="text-secondary">Elegant premium watch</p>
                    <h5 class="fw-bold">250.000</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in">
            <div class="card product-card shadow-sm" onclick="window.location.href='/tshirt'">
                <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=1000" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">T-Shirt</h4>
                    <p class="text-secondary">Oversized modern style</p>
                    <h5 class="fw-bold">50.000</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3" data-aos="zoom-in" data-aos-delay="200">
            <div class="card product-card shadow-sm" onclick="window.location.href='/jacket'">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1000" class="card-img-top">
                <div class="card-body">
                    <h4 class="fw-bold">Jacket</h4>
                    <p class="text-secondary">Winter fashion collection</p>
                    <h5 class="fw-bold">180.000</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000 });
</script>

@endsection