@extends('layouts.mainlayout')
@section('title','Login')
@section('content')

<style>
    body { 
        background: #e9ecef; 
    }

    .login-wrapper {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 100px 20px 40px;
    }

    .login-container {
        width: 80%;
        max-width: 1100px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        display: flex;
    }

    .left-side {
        width: 60%;
        min-height: 560px;
        background-image: url('https://www.bmw.co.id/content/dam/bmw/common/all-models/m-series/series-overview/bmw-m-series-seo-overview-ms-04.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.3);
    }

    .left-text {
        position: absolute;
        bottom: 40px;
        left: 40px;
        color: white;
        z-index: 2;
    }

    .left-text h1 { 
        font-size: 38px; 
        font-weight: bold; 
        margin-bottom: 8px; 
    }
    .left-text p  { 
        font-size: 15px; 
        width: 80%; 
        opacity: 0.9; }

    .right-side {
        width: 40%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 40px;
    }

    .login-box { 
        width: 100%; 
        max-width: 320px; 
    }

    .login-title { 
        font-size: 32px; 
        font-weight: bold; 
        margin-bottom: 6px; 
    }
    .login-subtitle { 
        color: gray; 
        margin-bottom: 30px; 
        font-size: 14px; 
    }

    .form-control {
        width: 100%;
        height: 50px;
        margin-bottom: 16px;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0 14px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .form-control:focus { 
        border-color: #0066cc; 
    }

    .login-btn {
        width: 100%;
        height: 50px;
        border: none;
        background: black;
        color: white;
        border-radius: 8px;
        transition: 0.3s;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .login-btn:hover { 
        background: #222; 
    }

    .register-text {
        margin-top: 20px;
        text-align: center;
        font-size: 14px;
        color: #666;
    }

    .register-text a { 
        color: #0066cc; 
        text-decoration: none; 
        font-weight: 500; 
    }
    .register-text a:hover { 
        text-decoration: underline; 
    }
    .error-msg { 
        color: red; 
        font-size: 13px; 
        margin-bottom: 14px; 
    }

    @media (max-width: 768px) {
        .login-container { flex-direction: column; width: 95%; }
        .left-side { width: 100%; min-height: 250px; }
        .right-side { width: 100%; }
    }
</style>

<div class="login-wrapper">
    <div class="login-container">

        <!-- LEFT -->
        <div class="left-side">
            <div class="overlay"></div>
            <div class="left-text">
                <h1>BMW Experience</h1>
                <p>Discover luxury, performance, and innovation with BMW future mobility.</p>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="right-side">
            <div class="login-box">
                <div class="login-title">Login</div>
                <div class="login-subtitle">Welcome back to BMW</div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if($errors->any())
                        <div class="error-msg">{{ $errors->first() }}</div>
                    @endif

                    <input type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required>

                    <input type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required>

                    <button class="login-btn">Login</button>
                </form>

                <div class="register-text">
                    Don't have an account?
                    <a href="/register">Register</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection