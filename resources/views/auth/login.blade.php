@extends('layouts.mainlayout')
@section('title','Login')
@section('content')

<style>
    

    body {
        background: #e9ecef;
        overflow: hidden;
    }

    .login-wrapper {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        width: 80%;
        max-width: 1100px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .left-side {
        height: 700px;
        background-image: url('https://www.bmw.co.id/content/dam/bmw/common/all-models/m-series/series-overview/bmw-m-series-seo-overview-ms-04.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
    }

    .left-text {
        position: absolute;
        bottom: 60px;
        left: 50px;
        color: white;
        z-index: 2;
    }

    .left-text h1 { font-size: 45px; font-weight: bold; }
    .left-text p  { font-size: 16px; width: 70%; }

    .right-side {
        height: 700px;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }

    .login-box { width: 100%; max-width: 350px; }
    .login-title { font-size: 32px; font-weight: bold; margin-bottom: 10px; }
    .login-subtitle { color: gray; margin-bottom: 35px; }

    .form-control {
        height: 50px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .login-btn {
        width: 100%;
        height: 50px;
        border: none;
        background: black;
        color: white;
        border-radius: 8px;
        transition: 0.3s;
        font-size: 16px;
    }

    .login-btn:hover { background: #222; }
    .register-text { margin-top: 20px; text-align: center; }
    .error-msg { color: red; font-size: 13px; margin-bottom: 14px; }
</style>

<div class="login-wrapper">
    <div class="container-fluid login-container">
        <div class="row">

            <!-- LEFT -->
            <div class="col-md-7 left-side">
                <div class="overlay"></div>
                <div class="left-text">
                    <h1>BMW Experience</h1>
                    <p>Discover luxury, performance, and innovation with BMW future mobility.</p>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-md-5 right-side">
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

                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:18px;">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember" style="font-size:13px; color:#666; margin:0;">Remember me</label>
                        </div>

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
</div>

@endsection