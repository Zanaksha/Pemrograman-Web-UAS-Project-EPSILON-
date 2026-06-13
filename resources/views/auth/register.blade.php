@extends('layouts.mainlayout')
@section('title','Register')
@section('content')

<style>
    .navbar { display: none !important; }

    body {
        background: #e9ecef;
        overflow: hidden;
    }

    .register-wrapper {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-container {
        width: 80%;
        max-width: 1100px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    }

    .left-side {
        height: 700px;
        background-image: url('https://www.bmw.co.id/content/dam/bmw/common/all-models/x-series/x7/2022/highlights/bmw-x-series-x7-sp-desktop.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.45);
    }

    .left-text {
        position: absolute;
        bottom: 60px;
        left: 50px;
        color: white;
        z-index: 2;
    }

    .left-text h1 { font-size: 45px; font-weight: bold; }
    .left-text p  { font-size: 16px; width: 75%; }

    .right-side {
        height: 700px;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }

    .register-box { width: 100%; max-width: 350px; }
    .register-title { font-size: 32px; font-weight: bold; margin-bottom: 10px; }
    .register-subtitle { color: gray; margin-bottom: 35px; }

    .form-control {
        height: 50px;
        margin-bottom: 18px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .register-btn {
        width: 100%;
        height: 50px;
        border: none;
        background: black;
        color: white;
        border-radius: 8px;
        transition: 0.3s;
        font-size: 16px;
    }

    .register-btn:hover { background: #222; }
    .login-text { margin-top: 20px; text-align: center; }
    .error-msg { color: red; font-size: 13px; margin-bottom: 14px; }
</style>

<div class="register-wrapper">
    <div class="container-fluid register-container">
        <div class="row">

            <!-- LEFT -->
            <div class="col-md-7 left-side">
                <div class="overlay"></div>
                <div class="left-text">
                    <h1>Join BMW</h1>
                    <p>Create your account and experience premium driving innovation with BMW.</p>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-md-5 right-side">
                <div class="register-box">
                    <div class="register-title">Register</div>
                    <div class="register-subtitle">Create your BMW account</div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @if($errors->any())
                            <div class="error-msg">{{ $errors->first() }}</div>
                        @endif

                        <input type="text"
                            name="name"
                            class="form-control"
                            placeholder="Full Name"
                            value="{{ old('name') }}"
                            required>

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

                        <input type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm Password"
                            required>

                        <button class="register-btn">Register</button>
                    </form>

                    <div class="login-text">
                        Already have an account?
                        <a href="/login">Login</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection