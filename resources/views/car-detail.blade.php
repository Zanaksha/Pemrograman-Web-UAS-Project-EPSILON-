@extends('layouts.mainlayout')

@section('title', 'EPSILON ' . $car->name)

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">

@php
    function carImg($img) {
        if (!$img) return null;
        return str_starts_with($img, 'http') ? $img : asset('images/' . basename($img));
    }
    $img1 = carImg($car->image);
    $img2 = carImg($car->image2) ?? $img1;
    $img3 = carImg($car->image3) ?? $img1;
@endphp

<section class="detail-hero">

<div class="left">
  <div class="image-viewer">
    <button class="arrow prev">&#10094;</button>
    <img id="mainImage" src="{{ $img1 }}" alt="EPSILON {{ $car->name }}">
    <button class="arrow next">&#10095;</button>
  </div>

  <div class="thumbs">
    <img class="thumb active" src="{{ $img1 }}" alt="">
    <img class="thumb" src="{{ $img2 }}" alt="">
    <img class="thumb" src="{{ $img3 }}" alt="">
  </div>
</div>

<div class="right">

  <div class="breadcrumb">
    <a href="/">Home</a>
    <span>&gt;</span>
    <a href="/models">Models</a>
    <span>&gt;</span>
    <span>EPSILON {{ $car->name }}</span>
  </div>

  <h1>EPSILON {{ $car->name }}</h1>

  <p>{{ $car->description ?? 'High performance with modern design and the latest EPSILON technology.' }}</p>

  <div class="spec">
    @if($car->power)
    <div>
      <img width="25" height="25" src="https://img.icons8.com/ios/50/FFFFFF/speedometer.png"/>
      Power: {{ $car->power }}
    </div>
    @endif
    @if($car->acceleration)
    <div>
      <img width="25" height="25" src="https://img.icons8.com/ios/50/FFFFFF/time--v1.png"/>
      0-100 km/h: {{ $car->acceleration }}
    </div>
    @endif
    @if($car->top_speed)
    <div>
      <img width="25" height="25" src="https://img.icons8.com/dotty/80/FFFFFF/speed.png"/>
      Top Speed: {{ $car->top_speed }}
    </div>
    @endif
  </div>

  <a href="/brochure/{{ $car->slug }}" class="btn-bro">
    <img width="25" height="25" src="https://img.icons8.com/pastel-glyph/64/FFFFFF/download--v1.png"/>
    Download Brochure
  </a>

  @auth
  <a href="/beli?model={{ urlencode('EPSILON ' . $car->name) }}&harga=Rp+{{ number_format($car->price ?? 0, 0, ',', '.') }}&type=car" class="btn-bro" style="margin-top:10px; display:inline-block;">
    Buy Now
  </a>
  @else
  <a href="/login" class="btn-bro" style="margin-top:10px; display:inline-block;">
    Buy Now
  </a>
  @endauth

</div>
</section>

<!-- SPEC -->
<section class="spec-section">
  <div class="spec-left">
    <h2>Specifications</h2>
    <div class="spec-list">
      @if($car->engine)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/wired/64/engine.png"/> Engine</span>
        <span>{{ $car->engine }}</span>
      </div>
      @endif
      @if($car->drivetrain)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/external-others-bomsymbols-/91/external-auto-car-others-bomsymbols--2.png"/> Drivetrain</span>
        <span>{{ $car->drivetrain }}</span>
      </div>
      @endif
      @if($car->power)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png"/> Power</span>
        <span>{{ $car->power }}</span>
      </div>
      @endif
      @if($car->torque)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/64/external-torque-wrench-electrician-element-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png"/> Torque</span>
        <span>{{ $car->torque }}</span>
      </div>
      @endif
      @if($car->acceleration)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png"/> 0-100 km/h</span>
        <span>{{ $car->acceleration }}</span>
      </div>
      @endif
      @if($car->top_speed)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png"/> Top Speed</span>
        <span>{{ $car->top_speed }}</span>
      </div>
      @endif
      @if($car->fuel_consumption)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/ios/50/petrol.png"/> Fuel Consumption</span>
        <span>{{ $car->fuel_consumption }}</span>
      </div>
      @endif
      @if($car->price)
      <div class="spec-row">
        <span><img width="25" height="25" src="https://img.icons8.com/ios/50/money.png"/> Price</span>
        <span>Rp {{ number_format($car->price, 0, ',', '.') }}</span>
      </div>
      @endif
    </div>
  </div>

  <div class="spec-right">
    <h2>Key Features</h2>
    <div class="feature-grid">
      <div class="feature-card">
        <h3><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/car.png"/> EPSILON Design</h3>
        <p>Aggressive exterior design with EPSILON's signature aerodynamic enhancements.</p>
      </div>
      <div class="feature-card">
        <h3><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/1A1A1A/convertible-roof-warning--v2.png"/> Premium Interior</h3>
        <p>Premium interior with high-quality materials and cutting-edge technology.</p>
      </div>
      <div class="feature-card">
        <h3><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/car-seat.png"/> Sport Seats</h3>
        <p>Premium sport seats with perfect support and comfort.</p>
      </div>
      <div class="feature-card">
        <h3><img width="48" height="48" src="https://img.icons8.com/pulsar-line/48/shield.png"/> Driving Assistant</h3>
        <p>The latest advanced safety and driver assistance systems.</p>
      </div>
    </div>
  </div>
</section>

<script>
let images = [
    "{{ $img1 }}",
    "{{ $img2 }}",
    "{{ $img3 }}"
];

let index = 0;
const mainImage = document.getElementById("mainImage");
const thumbs = document.querySelectorAll(".thumb");

function updateImage() {
    mainImage.src = images[index];
    thumbs.forEach((thumb, i) => {
        thumb.src = images[i];
        thumb.classList.toggle("active", i === index);
    });
}

document.querySelector(".prev").onclick = () => {
    index = (index - 1 + images.length) % images.length;
    updateImage();
};

document.querySelector(".next").onclick = () => {
    index = (index + 1) % images.length;
    updateImage();
};

thumbs.forEach((thumb, i) => {
    thumb.addEventListener("click", () => {
        index = i;
        updateImage();
    });
});

updateImage();
</script>

@endsection