@extends('layouts.mainlayout')
@section('title', 'Assistance & Service')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div style="height: 80px;"></div>

<style>
    body { font-family: 'Roboto', sans-serif; background-color: #f8f9fa; }
    .hover-card { transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer; }
    .hover-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important; }
    .text-hover-blue:hover { color: #004d85 !important; }
</style>

<header class="position-relative d-flex align-items-center text-white" style="background: url('bg.jpeg') center/cover no-repeat; min-height: 70vh;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.2) 100%);"></div>
    <div class="container position-relative z-1 py-5 my-5">
        <div class="row">
            <div class="col-lg-6 text-start">
                <h1 class="display-3 fw-bold text-uppercase mb-3">Assistance<br>& Service</h1>
                <p class="lead mb-4">We are here to support you, whenever and wherever you need us.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <!-- <a href="/contactinfo" class="btn px-4 py-2 fw-bold text-white" style="background-color: #0066B1;">Roadside Assistance</a>
                    <a href="/contactinfo" class="btn btn-outline-light px-4 py-2 fw-bold">Book a Service</a> -->
                </div>
            </div>
        </div>
    </div>
</header>

<section class="container position-relative z-2" style="margin-top: -60px;">
    <div class="row g-3">
        <div class="col-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm text-center p-4 d-flex flex-column align-items-center rounded-3" onclick="window.location.href='/customer'">
                <i class="bi bi-headset mb-3 text-dark" style="font-size: 2.5rem;"></i>
                <h6 class="fw-bold mb-2">24/7 Support</h6>
                <p class="text-muted small mb-0">We're here for you anytime, anywhere.</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm text-center p-4 d-flex flex-column align-items-center rounded-3" onclick="window.location.href='/contactinfo'">
                <i class="bi bi-truck mb-3 text-dark" style="font-size: 2.5rem;"></i>
                <h6 class="fw-bold mb-2">Roadside Assistance</h6>
                <p class="text-muted small mb-0">Get help on the road when you need it most. call 0800 123 4567</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm text-center p-4 d-flex flex-column align-items-center rounded-3" onclick="window.location.href='/buycar'">
                <i class="bi bi-calendar-check mb-3 text-dark" style="font-size: 2.5rem;"></i>
                <h6 class="fw-bold mb-2">Buy</h6>
                <p class="text-muted small mb-0">Buy easily.</p>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm text-center p-4 d-flex flex-column align-items-center rounded-3" onclick="window.location.href='/contactinfo'">
                <i class="bi bi-shield-check mb-3 text-dark" style="font-size: 2.5rem;"></i>
                <h6 class="fw-bold mb-2">BMW Trained Experts</h6>
                <p class="text-muted small mb-0">Your BMW is in the best hands.</p>
            </div>
        </div>
    </div>
</section>

<section class="container my-5 pt-5 pb-4">
    <div class="text-center mb-5">
        <p class="text-uppercase fw-bold text-muted small mb-1" style="letter-spacing: 2px;">Our Services</p>
        <h2 class="fw-bold display-6">How can we help you?</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm rounded-3 overflow-hidden" onclick="window.location.href='/contactinfo'">
                <img src="https://images.unsplash.com/photo-1625047509248-ec889cbff17f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FyJTIwTWFpbnRlbmFuY2UlMjAlMjYlMjBSZXBhaXJ8ZW58MHx8MHx8fDA%3D" class="card-img-top" alt="Maintenance" style="height: 180px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <h6 class="fw-bold mb-3">Maintenance & Repair</h6>
                    <p class="text-muted small mb-4">Keep your BMW in top condition with our comprehensive maintenance and repair services.</p>
                    <span class="fw-bold mt-auto small" style="color: #0066B1;">Learn More &rarr;</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm rounded-3 overflow-hidden" onclick="window.location.href='/contactinfo'">
                <img src="https://images.unsplash.com/photo-1617531653332-bd46c24f2068?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Parts" style="height: 180px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <h6 class="fw-bold mb-3">Genuine BMW Parts</h6>
                    <p class="text-muted small mb-4">We use only genuine BMW parts to ensure maximum performance and safety.</p>
                    <span class="fw-bold mt-auto small" style="color: #0066B1;">Learn More &rarr;</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm rounded-3 overflow-hidden" onclick="window.location.href='">
                <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Service" style="height: 180px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <h6 class="fw-bold mb-3">Service Inclusive</h6>
                    <p class="text-muted small mb-4">Enjoy predictable servicing costs with BMW Service Inclusive packages.</p>
                    <span class="fw-bold mt-auto small" style="color: #0066B1;">Learn More &rarr;</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card hover-card h-100 border-0 shadow-sm rounded-3 overflow-hidden" onclick="window.location.href='/customer'">
                <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Support" style="height: 180px; object-fit: cover;">
                <div class="card-body p-4 d-flex flex-column bg-white">
                    <h6 class="fw-bold mb-3">Customer Support</h6>
                    <p class="text-muted small mb-4">Our support team is ready to assist you with any questions or concerns.</p>
                    <span class="fw-bold mt-auto small" style="color: #0066B1;">Learn More &rarr;</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5 pb-3">
    <div class="rounded-3 overflow-hidden position-relative p-5 text-white d-flex align-items-center shadow-sm" style="background: url('https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat; min-height: 350px;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to right, rgba(0,0,0,0.9) 10%, rgba(0,0,0,0.2) 100%);"></div>
        <div class="position-relative z-1" style="max-width: 60%;">
            <p class="text-uppercase fw-bold small text-light mb-2" style="letter-spacing: 2px;">Roadside Assistance</p>
            <h2 class="display-5 fw-bold mb-3">Help is just a call away.</h2>
            <p class="mb-4 lead fs-6 text-light">From flat tires to battery issues, our team is ready to assist you 24/7, wherever you are.</p>
            <!-- <a href="/contactinfo" class="btn btn-light text-dark fw-bold px-4 py-2 mt-2">Contact Assistance</a> -->
        </div>
    </div>
</section>

@endsection