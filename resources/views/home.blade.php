@extends('layouts.mainlayout')

@section('title','Home')

@section('content')

<style>
  .hero {
  position: relative;
  min-height: 100vh;
  overflow: hidden;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, .45);
  z-index: 1;
}

.content {
  color: #666;
  position: relative;
  z-index: 2;
}

.anima {
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    width: 300%;
    height: 100%;
    animation: slides 15s infinite;
}

.anima img {
    width: 33.333%;
    height: 100%;
    object-fit: cover;
}

@keyframes slides {
  0%, 30% { transform: translateX(0); }
  33%, 63% { transform: translateX(-33.333%); }
  66%, 96% { transform: translateX(-66.666%); }
  100% { transform: translateX(0); }
}

.bg-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.navbar {
  position: absolute;
  width: 100%;
  z-index: 10;
  font-size: 20px;
  padding-top: 30px;
}

.navbar .nav-link,
.navbar:hover {
  color: rgb(255, 255, 255);
  margin-right: 15px;
}

.navbar-brand {
  color: rgb(255, 255, 255);
  margin-right: 15px;
}

.dropdown {
  position: relative;
}

.dropdown-menu {
  display: block;
  opacity: 0;
  visibility: hidden;
  transition: 0.3s ease;
  margin-top: 0;
}

.dropdown:hover .dropdown-menu {
  opacity: 1;
  visibility: visible;
}

.container-fluid {
  width: 90%;
  margin: auto;
}

.dropdown-toggle::after {
  display: none;
}

.nav-link {
  position: relative;
  display: inline-block;
  padding-bottom: 8px;
}

.nav-link::before {
  content: "";
  position: absolute;
  left: 50%;
  bottom: 0;
  transform: translateX(-50%);
  width: 0;
  height: 3px;
  background: #00a2ff;
  transition: 0.3s ease;
}

.nav-link:hover::before {
  width: 70px;
}

.okke {
  letter-spacing: 3px;
  font-size: 14.4px;
  font-weight: 600;
  color: white;
}

.hero-title {
  font-size: 80px;
  font-weight: 800;
  line-height: 1;
  margin-bottom: 20px;
  color: white;
}

.hero-text {
  font-size: 17.6px;
  max-width: 520px;
  color: #f0f0f0;
  margin-bottom: 30px;
}

.btn-light-bmw {
  background: white;
  color: black;
  text-decoration: none;
  padding: 12px 30px;
  border-radius: 40px;
  font-weight: 600;
}

.btn-light-bmw:hover {
  background: #e9e9e9;
}

.about {
  background: #f8f8f8;
  padding: 100px 0;
}

#newsCarousel {
  position: relative;
  width: 100%;
}

.slide-box {
  width: 85%;
  margin: 50px auto 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 80px;
}

.slide-text {
  flex: 1;
}

.slide-text h2 {
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 20px;
  color: #111;
}

.slide-text p {
  font-size: 16px;
  line-height: 1.8;
  color: #666;
  max-width: 500px;
}

.slide-image {
  flex: 1;
}

.slide-image img {
  width: 100%;
  height: 450px;
  object-fit: cover;
  border-radius: 20px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
}

.custom-arrow {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  background: white;
  box-shadow: 0 5px 20px rgba(0, 0, 0, .15);
  opacity: 1;
  top: 50%;
  transform: translateY(-50%);
}

.custom-arrow span {
  font-size: 32px;
  color: black;
}

.custom-arrow.carousel-control-prev {
  left: 40px;
  color: black;
}

.custom-arrow.carousel-control-next {
  right: 40px;
  color: black;
}

.custom-arrow::before {
  display: none;
}

.custom-indicators {
  bottom: -60px;
}

.custom-indicators [data-bs-target] {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #ccc;
  border: none;
  opacity: 1;
}

.custom-indicators .active {
  background-color: #dc3545;
}

@media (max-width: 992px) {
  .slide-box {
    width: 90%;
    flex-direction: column;
    text-align: center;
    gap: 30px;
  }
  .slide-text p { margin: auto; }
  .slide-text h2 { font-size: 35.2px; }
  .slide-image img { height: 320px; }
  .custom-arrow { display: none; }
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.fmodel {
  padding: 100px 0;
  background: white;
}

.section-title {
  text-align: center;
  font-size: 48px;
  font-weight: 800;
  margin-bottom: 10px;
}

.section-subtitle {
  text-align: center;
  color: #777;
}

.model-card {
  background: white;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
  transition: .3s;
}

.model-card:hover {
  transform: translateY(-10px);
}

.model-card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.model-card-body {
  padding: 20px;
}

.model-card-body h3 {
  font-size: 22.4px;
  font-weight: 700;
}

.model-card-body p {
  color: #777;
}

.model-card-body a {
  text-decoration: none;
  font-weight: 600;
  color: black;
}

.why-epsilon {
  background: white;
  padding: 100px 0;
}

.why-epsilon a {
  color: black;
  text-decoration: none;
  font-weight: 600;
}

.feature-box {
  background: white;
  border-radius: 18px;
  padding: 35px;
  height: 100%;
  text-align: center;
  transition: .3s;
}

.feature-box:hover {
  transform: translateY(-8px);
}

.feature-icon {
  font-size: 32px;
  margin-bottom: 15px;
}

.feature-box h3 {
  font-size: 20.8px;
  margin-bottom: 10px;
}

.feature-box p {
  color: #777;
}

.site-footer {
  background: #0f0f0f;
  color: white;
  padding: 70px 0 25px;
}

.footer-top {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  gap: 40px;
  margin-bottom: 40px;
}

.footer-logo {
  width: 60px;
  margin-bottom: 15px;
}

.footer-col,
.footer-social {
  display: flex;
  flex-direction: column;
}

.footer-col h4,
.footer-social h4 {
  margin-bottom: 15px;
  font-size: 17.6px;
}

.footer-col a {
  color: #ccc;
  text-decoration: none;
  margin-bottom: 8px;
}

.footer-col a:hover {
  color: white;
}

.social-icons {
  display: flex;
  gap: 10px;
}

.social-icons img {
  width: 35px;
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, .1);
  padding-top: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 15px;
}

.footer-bottom p {
  margin: 0;
}

.footer-links {
  display: flex;
  gap: 10px;
  align-items: center;
}

.footer-links a {
  color: #ccc;
  text-decoration: none;
}

.footer-links a:hover {
  color: white;
}

@media(max-width:992px) {
  .hero-title { font-size: 48px; }
  .hero-image-frame { display: none; }
  .section-title { font-size: 35.2px; }
  .footer-top { flex-direction: column; }
  .footer-bottom { flex-direction: column; text-align: center; }
}

#preloader {
  position: fixed;
  inset: 0;
  background: #000;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  transition: opacity 0.6s ease, visibility 0.6s ease;
}
#preloader.hide {
  opacity: 0;
  visibility: hidden;
}
.pre-tagline {
  letter-spacing: 5px;
  font-size: 11px;
  font-weight: 600;
  color: #666;
  text-transform: uppercase;
  opacity: 0;
  transform: translateY(10px);
  animation: fadeUp 0.6s ease 0.2s forwards;
}
.pre-title {
  font-size: 56px;
  font-weight: 800;
  color: #fff;
  letter-spacing: 8px;
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.7s ease 0.5s forwards;
  margin: 8px 0 32px;
}
.pre-line {
  width: 0;
  height: 2px;
  background: #fff;
  animation: expandLine 0.8s ease 1s forwards;
}
.pre-sub {
  font-size: 11px;
  letter-spacing: 4px;
  color: #444;
  text-transform: uppercase;
  opacity: 0;
  animation: fadeIn 0.5s ease 1.6s forwards;
  margin-top: 20px;
}
@keyframes fadeUp {
  to { opacity: 1; transform: translateY(0); }
}
@keyframes expandLine {
  to { width: 120px; }
}
@keyframes fadeIn {
  to { opacity: 1; }
}
</style>


  <div id="preloader">
    <p class="pre-tagline">Performance Series</p>
    <h1 class="pre-title">EPSILON</h1>
    <div class="pre-line"></div>
    <p class="pre-sub">Loading experience&hellip;</p>
  </div>
      
  <section class="hero">

    <div class="hero-overlay"></div>

    <div class="Gambar">
      <div class="anima">
        <img src="https://images.unsplash.com/photo-1680844540129-48dacc7d5d88?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTUwfHxibXd8ZW58MHx8MHx8fDA%3D" alt="">
        <img src="https://images.unsplash.com/photo-1536696459897-0fdfe270ab4b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjQ1fHxibXd8ZW58MHx8MHx8fDA%3D" alt="">
        <img src="https://images.unsplash.com/photo-1708063785687-53f175935774?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzgzfHxibXd8ZW58MHx8MHx8fDA%3D" alt="">
      </div>

      <div class="container-fluid site-width hero-content position-relative z-2">
        <div class="row align-items-center min-vh-100 g-5">
          <div class="col-lg-5">
            <p class="okke mb-3">EPSILON PERFORMANCE SERIES</p>
            <h1 class="hero-title">EPSILON M8 GRAN COUPÉ</h1>
            <p class="hero-text">
              Experience uncompromising performance, luxury, and innovation in a vehicle engineered to
              redefine every journey.
            </p>
            <div class="hero-actions d-flex flex-wrap gap-3">
              <a href="/models" class="btn btn-light-bmw">Explore Models <span>›</span></a>
            </div>
          </div>

        </div>
      </div>

  </section>

  <section class="fmodel">
    <div class="container-fluid site-width">
      <h2 class="section-title mb-3">FEATURED MODELS</h2>
      <p class="section-subtitle mb-5">Explore the range of high performance and luxury.</p>

      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="model-card h-100">
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS91Zys8%25P6EaURyfNwOTjHADv6Ojd%25p12aKkiH0scCuHVsaAb0%25lR2oubWTkFKqvLB9oeWF5Ga2ysId4e%257SxfBzAF3aJQbAFKdqf62lKwLVM%258w0KETayVqTbhBHHS9WZFSrCWcFtTjO3GgiTQdjcjTW3azDx4o1dnkq8cF4zOALUxKPkIFJG8WkABKupC9PFeWS6ldbKMPVYXzsWhbNmQFnPo90yW7NbHi4TPYR9%25wc3bKHiftxd9WDw178ziZqtECUkw5z7slGAtadCrXpF7sDlZQ6KCrrXRaYWlH8Q5nmPX%25QagOybQB7nvIT9FoZO2B3iKHvIjedwWChBDMztPuzeqhk7bSEMLoAC9VLhJHFlievou%25KXwD6HSfWQrgu%25V1PaZcMfNEbnRx310s9O5z6E4riIgkAscZwBvg7rxRte2yzZ857MjgRRUgChDS35Gvlovsggp2XH2yyv6jQ%25j1t2YDafD6xjmBjVwsoH0%25l05zxO4WsyZOvdImvhjVB5xbZP%25F6Y8snGXMESk%25CaDi2aKSAmxscCEI5s%25rt3Xe" alt="BMW M4">
            <div class="model-card-body">
              <h3>IX</h3>
              <p>503 HP • 3.9 s • from <br>Rp 1.406.944.800</p>
              <a href="/ix">View Details</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="model-card h-100">
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPDDiUi5Bo0aVo7UwFyjmBjVwsoH0%25l0YxxO4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWly%25V1PaXGmfNEbnQrX10s9OaZ9E4riInRdscZwBO5xrxRteJOGZ857Mu1vRUgChSU75GvloVm3gp2XHNaMv6jQ%25gJq2YDafvR6jmqn12mUDyLOEjy5qTJIsDRXL3uBrq76JdSeZLU2uzVMRJf0SkNh5ucQVA0ogSkwNF4HvVmP0Kc%252Nye4Wxfj0UucP81D5PAxbUEqgmP89GsLvS6UiprJ2CrGw6ZujlaptYRSDUW67m5VdH9YCygNzaUmlTv0knfyX324AETTQdjcFAq3azDxKiodnkq8h4CzOALUoZkkIFJGH85ABKupK3FFeWS6WBQKMPVYoedWhbNmHMiPox9syh3b4gZqmazOSCmXz4RjayVFbYCja1%25P4fFSr9VSxbZG7NgXA2Jf3KuvQnOlZyrU1OIXYuaq4y9%25UnpqyBLayV3WJY" alt="BMW M8 Gran Coupé">
            <div class="model-card-body">
              <h3>IX1</h3>
              <p>617 HP • 3.2 s • from <br>Rp 1.872.360.000</p>
              <a href="/ix1">View Details</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="model-card h-100">
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgMyDkRUQoFSr9VJdoMXOBeypTjH1sD3Ui5Bo0aVo7UwFyjmBjVwsoH0%25l0gfHR4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWcm%25V1PaXlsfNEbnQpy10s9OaZQE4riInRiscZwBO5MrxRteIgrZ857MBvuRUgChSD25GvloVeYgp2XHNrDv6jQ%250Zk2YDaf4iujmqn1cvfDyLOEx2UqTJIsDNOL3uBrq1kJdSeZLjbuzVMRJDdSkNh5ukxVA0ogSjwNF4HvVDd0Kc%252Nd44Wxfj0zacP81D4wGxbUEqc7F89GsLxCUUiprJ8lLGw6ZuU2eptYRSGTL67m5VptIYCygN67QmlTv0YCgyX324mllTQdjcy9O3azDxTi5dnkq83wdzOALUdKmkIFJG49OABKupcmPFeWS6xHSKMPVY8%257WhbNmUfhPo90yGKDbHi4TpeZ9%25wc3lsKiftxdXrLw178zQuvtECUkaSV7slGAngbCrXpFOvWlZQ6KI2lXRaYWBIyQ5nmPeJNagOybMfunvIT9h1yO2B3iuzvIjedwS73BDMztMaeeqhk7hSSMLoACoq4hJHFlHLgou%25KXVMKHSfWQqSr%25Vi18aSOfbYGdQ2BDFRQgBbpT2aKhfXRT2c0%25b4hFU1KFifG7ZWYgMyk4OoAmvjD5GaUtcDqgXA2dba10tjCdaLz2aKOHkX" alt="BMW M5">
            <div class="model-card-body">
              <h3>I7</h3>
              <p>617 HP • 3.3 s • from <br>Rp 1.872.360.000</p>
              <a href="/i7">View Details</a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="model-card h-100">
            <img src="https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPs7MUi5Bo0aVo7UwFyjmBjVwsoH0%25l0CzrH4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQlO%25%25V1PaXGmfNEbnQrX10s9ODQxE4riIqHRscZwBLGxrxRteJ68Z857MulIRUgChZE85GvloRG4gp2XH5psv6jQ%25gFx2YDafvKAjmqn12WGDyLOEjztqTJIsDFiL3uBrqUQJdSeZLGJuzVMRJ0jSkNh5EkTVA0ogsU3NF4HvrbH0Kc%252Z9E4WxfjRiWcP81D5w4xbUEqg4O89GsLvcAUiprJyVWGw6ZuTkiptYRS3XR67m5VdQ8YCygNzaHmlTv0knXyX324AO1TQdjcFs73azDxKrZdnkq8WTdzOALUPWukIFJGb7fABNK%25pIYFSr1vGCyXqiGtySE5CpLdFUi5CoMAShdqfKLqNF1c9Jrt3RjhYzDZ7lXw1pf4oXQtUDCvSpKM4lxvpa2CpLYkjU" alt="BMW X5">
            <div class="model-card-body">
              <h3>I4</h3>
              <p>523 HP • 4.3 s • from <br>Rp 1.522.852.800</p>
              <a href="/i4">View Details</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="about">
    <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
      <h2 class="section-title">WHY EPSILON</h2>
      <p class="section-subtitle">Sheer driving pleasure, every single day.</p>

      <div class="carousel-indicators custom-indicators">
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="3"></button>
      </div>

      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="slide-box">
            <div class="slide-text">
              <h2>UNMATCHED PERFORMANCE</h2>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere obcaecati laborum dolor, impedit
                perspiciatis odit ullam eum veniam, ipsum quia nemo corrupti? Voluptates hic reiciendis rem iusto eius.
                Fugiat, voluptate.
              </p>

            </div>

            <div class="slide-image">
              <img src="https://images.unsplash.com/photo-1516892530436-5773dc77dfbe?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDA2fHxibXd8ZW58MHx8MHx8fDA%3D" alt="slide 1">
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="slide-box">
            <div class="slide-text">
              <h2>LUXURY REFINED</h2>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi ipsa pariatur, maiores expedita ad
                libero.
              </p>

            </div>

            <div class="slide-image">
              <img src="https://images.unsplash.com/photo-1622642468182-edd7db43f86e?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDQyfHxibXd8ZW58MHx8MHx8fDA%3Ds" alt="slide 2">
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="slide-box">
            <div class="slide-text">
              <h2>ADVANCED SAFETY</h2>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, quod.
              </p>

            </div>

            <div class="slide-image">
              <img src="https://images.unsplash.com/photo-1680242747871-25ee33b117fc?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTQwfHxibXd8ZW58MHx8MHx8fDA%3D" alt="slide 3">
            </div>
          </div>
        </div>

        <div class="carousel-item">
          <div class="slide-box">
            <div class="slide-text">
              <h2>PREMIUM</h2>
              <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto odio laboriosam enim ducimus
                numquam eaque veniam illum neque? Eos libero necessitatibus quidem, sint enim voluptas odio consectetur!
                Beatae, animi fugit!
              </p>

            </div>

            <div class="slide-image">
              <img src="https://images.unsplash.com/photo-1622230329002-ed2261187410?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTY5fHxibXd8ZW58MHx8MHx8fDA%3D" alt="slide 4">
            </div>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev custom-arrow" type="button" data-bs-target="#newsCarousel"
        data-bs-slide="prev">
        <span aria-hidden="true">‹</span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next custom-arrow" type="button" data-bs-target="#newsCarousel"
        data-bs-slide="next">
        <span aria-hidden="true">›</span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </section>

  <section class="why-epsilon">
    <div class="container-fluid site-width">
      <h2 class="section-title">Ready to find your next EPSILON?</h2>
      <p class="section-subtitle">Explore all EPSILON has to offer and get behind the wheel today.</p>

      <div class="row g-4 mt-1">
        <div class="col-md-6 col-lg-3">
          <div class="feature-box">
            <div class="feature-icon"><img width="50" height="50"
                src="https://img.icons8.com/carbon-copy/100/garage.png" alt="garage" /></div>
            <h3>Find A Dealer</h3>
            <p>Find your nearest EPSILON dealer and experience premium service firsthand.</p>
            <a href="/finddealer">Find now</a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-box">
            <div class="feature-icon"><img width="50" height="50" src="https://img.icons8.com/ios/50/car--v1.png"
                alt="car--v1" /></div>
            <h3>Shop new vehicles</h3>
            <p>Explore luxury, innovation, and performance in every EPSILON.</p>
            <a href="/buycar">Browse Shop</a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-box">
            <div class="feature-icon"><img width="50" height="50" src="https://img.icons8.com/ios/50/headset--v1.png"
                alt="headset--v1" /></div>
            <h3>Customer Supports</h3>
            <p>We're here to assist you every step of the way.</p>
            <a href="/customer">Ask now</a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="feature-box">
            <div class="feature-icon"><img width="50" height="50"
                src="https://img.icons8.com/parakeet-line/48/certificate.png" alt="certificate" /></div>
            <h3>Warranties</h3>
            <p>Drive with confidence backed by comprehensive EPSILON protection.</p>
            <a href="/warranty">Learn more</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  


<script>
  function hidePreloader() {
    const el = document.getElementById('preloader');
    if (el) {
      setTimeout(() => {
        el.classList.add('hide');
      }, 3000);
    }
  }

  if (document.readyState === 'complete') {
    hidePreloader();
  } else {
    window.addEventListener('load', hidePreloader);
  }
</script>


@endsection