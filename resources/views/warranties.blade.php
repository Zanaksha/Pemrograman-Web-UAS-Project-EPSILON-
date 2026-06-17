@extends('layouts.mainlayout')

@section('title','Waranties')

@section('content')

<style>
body{font-family:sans-serif;font-size:14px}
.nav-dark{background:#111}
.nav-dark .nav-link{color:rgba(255,255,255,.8)!important;font-size:.8rem;text-transform:uppercase;letter-spacing:.05em}
.hero{background:#111;min-height:280px;position:relative;overflow:hidden}
.hero img{position:absolute;right:0;top:0;height:100%;width:60%;object-fit:cover;opacity:.5}
.hero-text{position:relative;z-index:2;padding:3rem}
.hero-text h1{font-size:3rem;font-weight:800;color:#fff}
.hero-text p{color:rgba(255,255,255,.7);max-width:380px}
.w-card{border:1px solid #ddd;border-radius:6px;padding:1.5rem;text-align:center;height:100%}
.w-card .icon{font-size:2rem;color:#1c69d4;margin-bottom:.75rem}
.w-card .label{font-size:.75rem;color:#666;margin-bottom:.25rem}
.w-card .dur{font-size:1.2rem;font-weight:700;margin-bottom:.5rem}
.w-card p{font-size:.82rem;color:#555;margin:0}
.check-li{list-style:none;padding:0}
.check-li li{padding:.4rem 0;border-bottom:1px solid #eee;font-size:.88rem}
.check-li li:last-child{border:none}
.x-li{list-style:none;padding:0}
.x-li li{padding:.35rem 0;font-size:.88rem}
.keep-card{background:#eef4ff;border:1px solid #c5d9f7;border-radius:6px;padding:1.5rem}
.vin-section{background:#111;padding:3rem 0}
.vin-section *:not(.btn){color:#fff}
.vin-section input{background:rgba(255,255,255,.1);border:none;color:#fff}
.vin-section input::placeholder{color:rgba(255,255,255,.4)}
.help-card{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:6px;padding:1.5rem}
.footer-dark{background:#111;padding:2.5rem 0 1rem}
.footer-dark *{color:rgba(255,255,255,.6)!important;font-size:.82rem}
.footer-dark h6{color:rgba(255,255,255,.9)!important;font-weight:700;font-size:.78rem;letter-spacing:.08em;text-transform:uppercase}
.footer-dark a:hover{color:#fff!important}
.social a{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid rgba(255,255,255,.25);border-radius:50%;margin-right:.3rem;font-size:.9rem}
.blue{color:#1c69d4!important}
</style>


<!-- HERO -->
<section class="hero">
  <img src="car1.jpg" alt="BMW"/>
  <div class="hero-text">
    <h1 style="margin-top:200px">Warranty</h1>
    <p>Drive with confidence. Our warranty coverage is designed to protect your BMW and your peace of mind.</p>
  </div>
</section>

<!-- WARRANTY AT A GLANCE -->
<section class="py-5">
  <div class="container">
    <h4 class="text-center fw-bold mb-4">Your Warranty at a Glance</h4>
    <div class="row g-3">
      <div class="col-sm-6 col-lg-3">
        <div class="w-card">
          <div class="icon"><i class="bi bi-shield-check"></i></div>
          <p class="label">New Vehicle Limited Warranty</p>
          <div class="dur">4 Years / 80,000 km</div>
          <p>Covers most vehicle components against defects in materials or workmanship.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="w-card">
          <div class="icon"><i class="bi bi-gear-wide-connected"></i></div>
          <p class="label">Powertrain Limited Warranty</p>
          <div class="dur">4 Years / 80,000 km</div>
          <p>Covers the engine, transmission, and drivetrain components.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="w-card">
          <div class="icon"><i class="bi bi-truck"></i></div>
          <p class="label">Roadside Assistance</p>
          <div class="dur">4 Years / Unlimited km</div>
          <p>24/7 support for emergencies like towing, battery jump-start, flat tire, and more.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="w-card">
          <div class="icon"><i class="bi bi-droplet-half"></i></div>
          <p class="label">Rust Perforation Warranty</p>
          <div class="dur">12 Years / Unlimited km</div>
          <p>Covers rust perforation due to defects in materials or workmanship.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT'S COVERED -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-4">
        <h4 class="fw-bold">What's Covered?</h4>
        <p class="text-muted small">Our warranty covers defects in materials and workmanship for the duration specified. Coverage may vary by model and region.</p>
        <a href="#" class="btn btn-outline-primary btn-sm">View Full Warranty Details →</a>
      </div>
      <div class="col-lg-4">
        <ul class="check-li">
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>Engine and transmission components</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>Electrical systems</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>Air conditioning</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>Fuel system</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>Steering and suspension</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i>And much more</li>
        </ul>
      </div>
      <div class="col-lg-4">
        <img src="ca2.jpg" class="img-fluid rounded" alt="BMW Interior"/>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-7">
        <h4 class="fw-bold">What's Not Covered?</h4>
        <p class="text-muted small">Your warranty does not cover damage or failures caused by:</p>
        <div class="row">
          <div class="col-6">
            <ul class="x-li">
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Normal wear and tear</li>
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Improper maintenance</li>
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Accidents or collisions</li>
            </ul>
          </div>
          <div class="col-6">
            <ul class="x-li">
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Modifications or alterations</li>
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Use of non-genuine BMW parts</li>
              <li><i class="bi bi-x-circle-fill text-danger me-2"></i>Damage due to neglect or misuse</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="keep-card">
          <div class="d-flex align-items-center gap-2 mb-2">
            <i class="bi bi-info-circle blue fs-5"></i>
            <strong>Keep Your Warranty Valid</strong>
          </div>
          <p class="text-muted small mb-3">Regular maintenance and servicing at authorized BMW Service Centers helps keep your warranty valid and your BMW performing at its best.</p>
          <a href="#" class="blue text-decoration-none small fw-semibold">Find a Service Center →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="vin-section">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-7">
        <h4 class="fw-bold">Check Your Warranty Status</h4>
        <p class="small" style="color:rgba(255,255,255,.6)">Enter your VIN to view your warranty information.</p>
       <form action="/warranties/check" method="POST" style="max-width:480px">
            @csrf
            <div class="input-group mt-2">
                <input type="text" name="vin" class="form-control" placeholder="Enter your VIN (e.g., WBA12345678901234)" value="{{ old('vin') }}" required/>
                <button class="btn btn-primary px-4" type="submit">Check Status</button>
            </div>
        </form>

        @if(isset($warranty))
        <div class="mt-4 p-3 rounded" style="background:rgba(255,255,255,0.1); max-width:480px;">
            <h5 class="fw-bold">{{ $warranty->car_model }} ({{ $warranty->car_year }})</h5>
            <p class="mb-1">VIN: <strong>{{ $warranty->vin }}</strong></p>
            @php $now = \Carbon\Carbon::now(); $end = \Carbon\Carbon::parse($warranty->warranty_end); @endphp
            @if($now->lt($end))
            <div class="alert alert-success mt-2 mb-0">
                ✅ <strong>Warranty Aktif!</strong> Berlaku hingga {{ $end->format('d M Y') }} ({{ $now->diffInDays($end) }} hari lagi)
            </div>
            @else
            <div class="alert alert-danger mt-2 mb-0">
                ❌ <strong>Warranty Expired!</strong> Berakhir pada {{ $end->format('d M Y') }}
            </div>
            @endif
        </div>
        @elseif(isset($error))
        <div class="alert alert-warning mt-3" style="max-width:480px;">
            ⚠️ {{ $error }}
        </div>
        @endif
      </div>
      <div class="col-lg-5">
        <div class="help-card d-flex gap-3 align-items-start">
          <i class="bi bi-clipboard2-check fs-2 blue"></i>
          <div>
            <strong>Need Help?</strong>
            <p class="small mb-1" style="color:rgba(255,255,255,.55)">Our support team is here to assist you with any warranty-related questions.</p>
            <a href="#" class="blue text-decoration-none small fw-semibold">Contact Support →</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h4 class="fw-bold mb-4">Frequently Asked Questions</h4>
    <div class="accordion" id="faq">
      <div class="accordion-item border mb-2 rounded">
        <h2 class="accordion-header"><button class="accordion-button fw-semibold" data-bs-toggle="collapse" data-bs-target="#f1">How do I know if my BMW is still under warranty?</button></h2>
        <div id="f1" class="accordion-collapse collapse show" data-bs-parent="#faq"><div class="accordion-body text-muted small">You can check your warranty status using the VIN lookup tool above, or contact your nearest authorized BMW Service Center.</div></div>
      </div>
      <div class="accordion-item border mb-2 rounded">
        <h2 class="accordion-header"><button class="accordion-button collapsed fw-semibold" data-bs-toggle="collapse" data-bs-target="#f2">Does the warranty transfer to a new owner?</button></h2>
        <div id="f2" class="accordion-collapse collapse" data-bs-parent="#faq"><div class="accordion-body text-muted small">Yes, the BMW New Vehicle Limited Warranty is fully transferable to subsequent owners within the warranty period.</div></div>
      </div>
      <div class="accordion-item border mb-2 rounded">
        <h2 class="accordion-header"><button class="accordion-button collapsed fw-semibold" data-bs-toggle="collapse" data-bs-target="#f3">What should I do if I experience an issue?</button></h2>
        <div id="f3" class="accordion-collapse collapse" data-bs-parent="#faq"><div class="accordion-body text-muted small">Contact your authorized BMW Service Center as soon as possible. Bring your warranty documents and VIN. Do not attempt unauthorized repairs.</div></div>
      </div>
      <div class="accordion-item border rounded">
        <h2 class="accordion-header"><button class="accordion-button collapsed fw-semibold" data-bs-toggle="collapse" data-bs-target="#f4">Can I extend my warranty?</button></h2>
        <div id="f4" class="accordion-collapse collapse" data-bs-parent="#faq"><div class="accordion-body text-muted small">Yes, BMW offers extended service contracts beyond the original warranty period. Contact your BMW dealer for details.</div></div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
