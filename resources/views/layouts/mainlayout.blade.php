<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</head>
<body>
<style>
    html, body {
    overflow-x: hidden;
    max-width: 100%;
    }
   
    .hero {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
    }

    .dropdown-menu { 
        z-index: 9999 !important; 
    }

    .leaflet-container { 
        z-index: 1; 
    }

    .content {
        color: rgb(255, 255, 255);
        position: relative;
        z-index: 2;
    }

    .isi { 
        min-height: 70vh; 
    }

    /* ===== NAVBAR ===== */
    .navbar {
        position: absolute;
        width: 100%;
        z-index: 10;
        font-size: 16px;
        padding-top: 20px;
        padding-bottom: 20px;
        background: linear-gradient(to bottom, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0) 100%);
        transition: background 0.4s ease;
    }

    .navbar.scrolled {
        position: fixed;
        background: rgba(0, 0, 0, 0.4) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        padding-top: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: #ffffff !important;
        text-shadow: 0 1px 4px rgba(0,0,0,0.8);
    }

    .navbar .nav-link:hover { 
        color: #fff !important; }

    .anima {
        position: absolute;
        top: 0; left: 0;
        display: flex;
        width: 200%;
        height: 100%;
        z-index: -1;
        animation: slides 12s infinite;
    }

    .anima img {
        width: 50%;
        height: 100%;
        object-fit: cover;
        flex-shrink: 0;
    }

    @keyframes slides {
        0%,45%  { transform: translateX(0); }
        50%,95% { transform: translateX(-50%); }
        100%    { transform: translateX(0); }
    }

    .bg-video {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    .container-fluid { 
        width: 90%; 
        margin: auto; 
    }

    .dropdown { 
        position: relative;
    }

    .dropdown-toggle::after { 
        display: none; 
    }

    .dropdown-menu {
        display: block;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
        margin-top: 0;
        background: rgba(10,10,10,0.95);
        border: 1px solid #222;
    }

    .dropdown-menu .dropdown-item { 
        color: #ccc; 
        font-size: 14px; 
    }

    .dropdown-menu .dropdown-item:hover { 
        background: #1a1a1a; 
        color: #fff;
     }

    .dropdown:hover .dropdown-menu { 
        opacity: 1; 
        visibility: visible; 
    }

    .nav-link {
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
        margin-right: 15px;
    }

    .nav-link::before {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        width: 0;
        height: 3px;
        background: #0066cc;
        transition: 0.3s ease;
    }

    .nav-link:hover::before { width: 70px; }

    /* ===== SEARCH BAR ===== */
    .search-wrap {
        display: flex;
        align-items: center;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 6px;
        padding: 0 12px;
        height: 36px;
        gap: 8px;
        transition: background 0.2s, border-color 0.2s;
        backdrop-filter: blur(4px);
    }

    .search-wrap:focus-within {
        background: rgba(255,255,255,0.15);
        border-color: #0066cc;
    }

    .search-wrap input {
        background: transparent;
        border: none;
        outline: none;
        color: #fff;
        font-size: 13px;
        width: 150px;
    }

    .search-wrap input::placeholder { 
        color: rgba(255,255,255,0.5); 
    }

    .search-wrap svg { 
        color: rgba(255,255,255,0.6); 
        flex-shrink: 0; 
    }

    .bottom-bar {
        position: absolute;
        left: 0; bottom: 0;
        height: 10%; width: 100%;
        background: #000;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 40px;
        z-index: 20;
    }

    .bar-left p { 
        margin: 0; 
        font-size: 15px; 
        max-width: 550px; 
    }

    .bar-center { 
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
     }

    .bar-center strong { 
        font-weight: 700; 
    }

    .arrow { 
        font-size: 28px; 
        line-height: 1;
     }

    .bar-right { 
        display: flex; 
        align-items: center; 
        gap: 10px; 
    }

    .stars {
        color: #f5c542;
        position: relative;
        display: inline-block;
        text-decoration: none;
    }

    .stars::after {
        content: "";
        position: absolute;
        left: 0; bottom: -5px;
        width: 0%; height: 2px;
        background: #f5c542;
        transition: 0.3s ease;
    }

    .stars:hover::after { 
        width: 70px;
     }

    .rating { 
        font-weight: 700; 
    }

    .about { 
        background: white; 
        padding: 80px 0 90px; 
        min-height: 100vh; }

    #newsCarousel { 
        position: relative; 
        width: 100%; }

    .slide-box {
        width: 80%;
        margin: 0 auto;
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 60px;
    }

    .slide-text { 
        width: 42%; 
    }
    .slide-text h2 { 
        font-size: 54px; 
        font-weight: 700; 
        line-height: 1; 
        letter-spacing: -1px; 
        text-transform: uppercase; 
        margin-bottom: 30px; 
    }
    .slide-text p { 
        font-size: 18px; 
        line-height: 1.5; 
        max-width: 420px; 
        margin-bottom: 40px; 
    }
    .slide-image { 
        width: 48%; 
    }
    .slide-image img { 
        width: 100%; 
        height: 600px; 
        object-fit: cover; 
        display: block; }

    .custom-arrow { 
        width: auto; 
        opacity: 1; 
        top: 50%; 
        transform: translateY(-50%); 
        font-size: 70px; color: #111; 
        text-decoration: none; 
    }

    .custom-arrow span { 
        font-size: 70px; 
        line-height: 1; 
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

    .custom-indicators [data-bs-target] { 
        width: 12px; 
        height: 12px; 
        border-radius: 50%; 
        background-color: #aaa; 
        border: none; 
        opacity: 1;
     }
    .custom-indicators .active { 
        background-color: #dc3545;
     }

    .site-footer {
        background: #111;
        color: #fff;
        padding: 60px 80px 30px;
    }

    .footer-top {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1fr 1fr;
        gap: 40px;
        margin-bottom: 50px;
    }

    .footer-brand p {
        color: #888;
        font-size: 13px;
        margin-top: 12px;
        line-height: 1.6;
        letter-spacing: 1px;
    }

    .footer-col h4 {
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #555;
        margin-bottom: 18px;
        font-weight: 500;
    }

    .footer-col a {
        display: block;
        color: #aaa;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 10px;
        transition: color 0.2s;
    }

    .footer-col a:hover { 
        color: #fff;
    }

    .social-icons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .social-icons a {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: .2s;
    }

    .social-icons a:hover { 
        background: white; 
        color: black; }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,.12);
        padding-top: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .footer-bottom p { 
        margin: 0; 
        color: #555; 
        font-size: 13px; 
    }

    .footer-links { 
        display: flex; 
        align-items: center; 
        gap: 12px; 
        flex-wrap: wrap; 
    }
    .footer-links a { 
        color: #555; 
        text-decoration: none; 
        font-size: 13px; }
    .footer-links a:hover { 
        color: #fff; 
    }
    .footer-links span { 
        color: #333;
     }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .slide-box { flex-direction: column; width: 90%; min-height: auto; }
        .slide-text, .slide-image { width: 100%; }
        .slide-image img { height: 420px; }
        .custom-arrow { display: none; }
        .search-wrap input { width: 100px; }
        .footer-top { grid-template-columns: repeat(2, 1fr); }
        .site-footer { padding: 40px 24px 24px; }
    }

    /* Force dropdown dark theme di semua halaman */
    .navbar .dropdown-menu {
        background: rgba(10,10,10,0.95) !important;
        border: 1px solid #222 !important;
    }

    .navbar .dropdown-menu .dropdown-item {
        color: #ccc !important;
        font-size: 14px !important;
        background: transparent !important;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background: #1a1a1a !important;
        color: #fff !important;
    }

    /* Halaman tanpa hero — navbar langsung fixed gelap */
    .navbar-solid {
        position: fixed !important;
        background: rgba(0, 0, 0, 0.4) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border-bottom: 1px solid rgba(255,255,255,0.08) !important;
    }   

    .profile-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:50%;
    background:#2563eb;
    color:white;
    font-weight:bold;
}

    .profile-menu{
    width:320px;
    right:0 !important;
    left:auto !important;
    transform:none !important;
}

    .profile-header{
        background:#2563eb;
        color:white;
        padding:20px;
    }

    .avatar-circle{
        width:42px;
        height:42px;
        border-radius:50%;
        background:white;
        color:#2563eb;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:bold;
        margin-right:10px;
    }

    .menu-item{
        padding:15px 20px;
        display:flex;
        align-items:center;
        gap:12px;
        font-size:15px;
    }

    .menu-item:hover{
        background:#f5f5f5;
    }


</style>

    <nav class="navbar navbar-expand-lg" id="mainNavbar">
        <div class="container-fluid">

            <a class="navbar-brand" href="/">
                <img src="https://www.bmw.co.id/content/dam/bmw/common/images/logo-icons/BMW/BMW_White_Logo.svg.asset.1670245093434.svg" alt="BMW" width="50" height="50">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/models">Models</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/warranty">Warranty</a></li>
                            <li><a class="dropdown-item" href="/buycar">Buy Car</a></li>
                            <li><a class="dropdown-item" href="/choosebuy">Side Product</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button">Service</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/finddealer">Find A Dealer</a></li>
                            <li><a class="dropdown-item" href="/assistant">Assistant & Service</a></li>
                            <li><a class="dropdown-item" href="/customer">Customer Support</a></li>
                            <li><a class="dropdown-item" href="/contactinfo">Contact & Info</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                </ul>

                @auth
                <div class="dropdown">
                    <button class="profile-btn" data-bs-toggle="dropdown">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </button>
                <div class="dropdown-menu profile-menu p-0">
                    <div class="profile-header">
                        <small>SIGNED IN AS</small>
                            <div class="d-flex align-items-center mt-2">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                              <span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                            <a href="/profile" class="dropdown-item menu-item">
                                👤<span>Profile</span>
                            </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                        <button type="submit" class="dropdown-item menu-item text-danger">
                                            🚪<span>Logout</span>
                                        </button>
                                    </form>
                                    @else
                                        <a href="/login" class="btn btn-outline-light ms-2">Login</a>
                                   </div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </nav>

    @yield('content')

    <footer class="site-footer">
        <div class="footer-top">
            <div class="footer-brand">
                <a class="navbar-brand" href="/">
                    <img src="https://www.bmw.co.id/content/dam/bmw/common/images/logo-icons/BMW/BMW_White_Logo.svg.asset.1670245093434.svg" alt="BMW" width="50" height="50">
                </a>
                <p>The Ultimate<br>Driving Machine</p>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <a href="/about">About Us</a>
            </div>

            <div class="footer-col">
                <h4>Quick Links</h4>
                <a href="/">Home</a>
                <a href="/models">Models</a>
                <a href="/shop">Shop</a>
                <a href="/assistant">Service</a>
            </div>

            <div class="footer-col">
                <h4>Support</h4>
                <a href="/contactinfo">Contact Us</a>
                <a href="/warranties">Warranty</a>
                <a href="/customer#FAQ">FAQ</a>
            </div>

            <div class="footer-col footer-social">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><img width="45" height="45" src="https://img.icons8.com/fluency/48/instagram-new.png" alt="instagram"/></a>
                    <a href="#"><img width="45" height="45" src="https://img.icons8.com/color/48/facebook.png" alt="facebook"/></a>
                    <a href="#"><img width="45" height="45" src="https://img.icons8.com/color/48/youtube-play.png" alt="youtube"/></a>
                    <a href="#"><img width="45" height="45" src="https://img.icons8.com/fluency/48/linkedin.png" alt="linkedin"/></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2025 BMW AG. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <span>|</span>
                <a href="#">Legal Notice</a>
                <span>|</span>
                <a href="#">Cookies</a>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        

        function handleSearch() {
            const query = document.getElementById('searchInput').value.trim();
            if (query !== '') {
                window.location.href = '/search?q=' + encodeURIComponent(query);
            }
        }

        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') handleSearch();
        });
    </script>

</body>
</html>