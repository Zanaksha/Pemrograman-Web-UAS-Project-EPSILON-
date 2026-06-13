@extends('layouts.mainlayout')

@section('title','X5')

@section('content')

<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">



<<section class="detail-hero">

<div class="left">
  <div class="image-viewer">

    <button class="arrow prev">&#10094;</button>

    <!-- GAMBAR UTAMA -->
    <img id="mainImage" src="BMW M4.png" alt="BMW M4">

    <button class="arrow next">&#10095;</button>

  </div>

  <!-- THUMBNAIL -->
  <div class="thumbs">

    <img class="thumb active"
    src="BMW M4.png" alt="">

    <img class="thumb"
    src="bmwbg.png" alt="">

    <img class="thumb"
    src="bmw2.png" alt="">

  </div>

</div>

<div class="right">

  <div class="breadcrumb">
    <a href="/">Home</a>
    <span>&gt;</span>
    <a href="/models">Models</a>
    <span>&gt;</span>
    <span>BMW X5</span>
  </div>

  <h1>BMW X5</h1>

  <p>
    High-performance coupe dengan desain agresif dan tenaga besar.
  </p>

  <div class="spec">

    <div>
      <img width="25" height="25"
      src="https://img.icons8.com/ios/50/FFFFFF/speedometer.png"/>
      Power: 510 HP
    </div>

    <div>
      <img width="25" height="25"
      src="https://img.icons8.com/ios/50/FFFFFF/time--v1.png"/>
      0-100 km/h: 3.9s
    </div>

    <div>
      <img width="25" height="25"
      src="https://img.icons8.com/dotty/80/FFFFFF/speed.png"/>
      Top Speed: 290 km/h
    </div>

  </div>

  <a href="#" class="btn-bro">

    <img width="25" height="25"
    src="https://img.icons8.com/pastel-glyph/64/FFFFFF/download--v1.png"/>

    Download Brochure

  </a>

  <!-- PILIH WARNA -->
  <div class="d-flex gap-3 mt-4">

    <!-- WHITE -->
    <button class="rounded-circle border border-2 border-dark"
    style="width:20px; height:20px; background:white;"
    onclick="changeCar('white')">
    </button>

    <!-- BLACK -->
    <button class="rounded-circle border border-2 border-dark"
    style="width:20px; height:20px; background:black;"
    onclick="changeCar('black')">
    </button>

    <!-- RED -->
    <button class="rounded-circle border border-2 border-dark"
    style="width:20px; height:20px; background:grey;"
    onclick="changeCar('grey')">
    </button>

  </div>

</div>
</section>

<!-- SPEC -->
<section class="spec-section">
  <div class="spec-left">
    <h2>Specifications</h2>

    <div class="spec-list">
      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/wired/64/engine.png" alt="engine"/> Engine</span>
        <span>3.0L TwinPower Turbo Inline 6-cylinder</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/external-outline-lafs/64/external-transmission-car-dashboard-outline-part-6-outline-lafs-4.png" alt="external-transmission-car-dashboard-outline-part-6-outline-lafs-4"/> Transmission</span>
        <span>8-Speed M Steptronic</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/external-others-bomsymbols-/91/external-auto-car-others-bomsymbols--2.png" alt="external-auto-car-others-bomsymbols--2"/> Drivetrain</span>
        <span>M xDrive (AWD)</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png" alt="speedometer"/> Power</span>
        <span>510 HP / 6250 rpm</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/64/external-torque-wrench-electrician-element-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png" alt="external-torque-wrench-electrician-element-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto"/> Torque</span>
        <span>650 Nm / 2750 rpm</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png" alt="speedometer"/> 0-100 km/h</span>
        <span>3.9 s</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/ios/50/speedometer.png" alt="speedometer"/> Top Speed</span>
        <span>290 km/h</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/ios/50/gas-station.png" alt="gas-station"/> Fuel Type</span>
        <span>Petrol</span>
      </div>

      <div class="spec-row">
        <span> <img width="25" height="25" src="https://img.icons8.com/ios/50/petrol.png" alt="petrol"/> Fuel Consumption</span>
        <span>10.2 l/100 km (WLTP)</span>
      </div>
    </div>
  </div>

  <div class="spec-right">
    <h2>Key Features</h2>

    <div class="feature-grid">
      <div class="feature-card">
        <h3> <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/car.png" alt="car"/> M Sport Design</h3>
        <p>Aggressive exterior design with aerodynamic enhancements.</p>
      </div>

      <div class="feature-card">
        <h3> <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/1A1A1A/convertible-roof-warning--v2.png" alt="convertible-roof-warning--v2"/> M Carbon Roof</h3>
        <p>Lightweight carbon roof for a lower center of gravity.</p>
      </div>

      <div class="feature-card">
        <h3> <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/car-seat.png" alt="car-seat"/> M Sport Seats</h3>
        <p>Premium sport seats with perfect support and comfort.</p>
      </div>

      <div class="feature-card">
        <h3> <img width="48" height="48" src="https://img.icons8.com/pulsar-line/48/shield.png" alt="shield"/> Driving Assistant</h3>
        <p>Advanced safety and driver assistance systems.</p>
      </div>
    </div>
  </div>
</section>


<script>

// =======================
// DEFAULT WHITE
// =======================

let currentImages = [
  "{{ asset('images/x5white1.png') }}",
  "{{ asset('images/x5white2.png') }}",
  "{{ asset('images/x5white3.png') }}"
];

let index = 0;

const mainImage =
document.getElementById("mainImage");

const thumbs =
document.querySelectorAll(".thumb");

// =======================
// UPDATE IMAGE
// =======================

function updateImage(){

    mainImage.src = currentImages[index];

    thumbs.forEach((thumb, i) => {

        thumb.src = currentImages[i];

        thumb.classList.toggle(
            "active",
            i === index
        );

    });

}

// =======================
// PREV BUTTON
// =======================

document.querySelector(".prev").onclick = () => {

    index =
    (index - 1 + currentImages.length)
    % currentImages.length;

    updateImage();

};

// =======================
// NEXT BUTTON
// =======================

document.querySelector(".next").onclick = () => {

    index =
    (index + 1)
    % currentImages.length;

    updateImage();

};

// =======================
// CLICK THUMB
// =======================

thumbs.forEach((thumb, i) => {

    thumb.addEventListener("click", () => {

        index = i;

        updateImage();

    });

});

// =======================
// CHANGE COLOR
// =======================

function changeCar(color){

    // WHITE
    if(color === 'white'){

        currentImages = [
          "{{ asset('images/x5white1.png') }}",
          "{{ asset('images/x5white2.png') }}",
          "{{ asset('images/x5white3.png') }}"
        ];

    }

    // BLACK
    if(color === 'black'){

        currentImages = [
          "{{ asset('images/x5black1.png') }}",
          "{{ asset('images/x5black2.png') }}",
          "{{ asset('images/x5black3.png') }}"
        ];

    }

    // GREY
    if(color === 'grey'){

        currentImages = [
          "{{ asset('images/x5grey1.png') }}",
          "{{ asset('images/x5grey2.png') }}",
          "{{ asset('images/x5grey3.png') }}"
        ];

    }

    index = 0;

    updateImage();

}

updateImage();

</script>

</body>

@endsection