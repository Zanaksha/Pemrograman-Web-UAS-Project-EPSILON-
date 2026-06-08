@extends('layouts.mainlayout')
@section('title','Contact & Info')
@section('content')

<div style="height: 80px;"></div>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .contact-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1) !important;
    }
    .icon-bmw { font-size: 2rem; color: #0066cc; }
    .text-bmw { color: #0066cc; }

    <style>
    /* Hilangkan gap di atas */
    body {
        padding-top: 0 !important;
    }

    /* Kasih jarak konten supaya tidak ketutupan navbar */
    .container.my-5 {
        margin-top: 100px !important;
    }

    .contact-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1) !important;
    }
    .icon-bmw { font-size: 2rem; color: #0066cc; }
    .text-bmw { color: #0066cc; }

    .contact-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1) !important;
    }
    .icon-bmw { font-size: 2rem; color: #0066cc; }
    .text-bmw { color: #0066cc; }
</style>


<section class="container my-5 py-4">
    <h2 class="text-center fw-bold mb-5">Contact Information</h2>

    <div class="row g-4 justify-content-center mb-4">
        <div class="col-md-4">
            <div class="contact-card h-100 text-center p-4 border rounded bg-white shadow-sm">
                <i class="bi bi-book icon-bmw mb-3 d-block"></i>
                <h5 class="fw-bold mb-3">Request a Brochure</h5>
                <p class="text-muted small mb-4">Download or request a digital catalogue for our models.</p>
                <a href="#" class="text-decoration-none fw-bold text-bmw mt-auto d-block">Get Brochure &rarr;</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-card h-100 text-center p-4 border rounded bg-white shadow-sm">
                <i class="bi bi-envelope icon-bmw mb-3 d-block"></i>
                <h5 class="fw-bold mb-3">Email Support</h5>
                <p class="text-muted small mb-4">Send us an email and we'll get back to you.</p>
                <a href="mailto:support@bmw.com" class="text-decoration-none fw-bold text-bmw mt-auto d-block">support@bmw.com</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="contact-card h-100 text-center p-4 border rounded bg-white shadow-sm">
                <i class="bi bi-telephone icon-bmw mb-3 d-block"></i>
                <h5 class="fw-bold mb-3">Call Center</h5>
                <p class="text-muted small mb-4">Speak with our support team.</p>
                <span class="fw-bold text-bmw mt-auto d-block">0800 123 4567</span>
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="contact-card h-100 text-center p-4 border rounded bg-white shadow-sm">
                <i class="bi bi-geo-alt icon-bmw mb-3 d-block"></i>
                <h5 class="fw-bold mb-3">Find a Dealer</h5>
                <p class="text-muted small mb-4">Find your nearest dealer or service center.</p>
                <a href="/finddealer" class="text-decoration-none fw-bold text-bmw mt-auto d-block">Find Dealer &rarr;</a>
            </div>
        </div>
        <div class="col-md-5 col-lg-4">
            <div class="contact-card h-100 text-center p-4 border rounded bg-white shadow-sm">
                <i class="bi bi-whatsapp icon-bmw mb-3 d-block"></i>
                <h5 class="fw-bold mb-3">WhatsApp</h5>
                <p class="text-muted small mb-4">Message us on WhatsApp.</p>
                <span class="fw-bold text-bmw mt-auto d-block">0812 3456 7890</span>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="bg-white p-5 border rounded shadow-sm">
                <h3 class="mb-4 fw-light text-uppercase text-center">Send Us a <span class="fw-bold">Message</span></h3>

                <form id="contactForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small">First Name</label>
                            <input type="text" class="form-control" placeholder="First" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Phone Number</label>
                            <input type="text" class="form-control" placeholder="+62" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">Inquiry Type</label>
                            <select class="form-select">
                                <option selected>Request for Offer</option>
                                <option value="1">General Question</option>
                                <option value="2">Technical Support</option>
                                <option value="3">Feedback / Complaint</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">Message</label>
                            <textarea class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-dark px-5 py-2 fw-bold text-uppercase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const formContact = document.getElementById('contactForm');
    formContact.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you! Your inquiry has been submitted to the BMW Team. We will contact you soon.');
        formContact.reset();
    });
</script>

@endsection