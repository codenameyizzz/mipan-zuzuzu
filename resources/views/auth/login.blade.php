@extends('layouts.auth')

@section('title', 'Login')

<link rel="icon" href="{{ asset('image/logo-ts.png') }}" type="image/x-icon">

@section('content')
<style>
    /* Reset Default Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #0E8AA9, #3CC1E2, #A5BABF);
    height: 100vh;
    display: flex;
    justify-content: center; 
    align-items: center; 
    margin: 0; 
    padding: 0 20px; 
}

.login-container {
    width: 100%;
    max-width: 1200px; /* Lebar maksimum login-container */
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    display: grid;
    grid-template-columns: 1fr 1fr; /* Dua kolom */
    overflow: hidden;
    margin: 0 auto; /* Memastikan konten selalu berada di tengah */
}


    /* Form Section */
    .login-form {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form h1 {
        font-size: 28px;
        font-weight: bold;
        color: #0E8AA9;
        margin-bottom: 10px;
    }

    .login-form h1 span {
        color: #3CC1E2;
    }

    .login-form h2 {
        font-size: 20px;
        margin: 20px 0;
        color: #333;
    }

    .login-form p {
        font-size: 14px;
        color: #777;
        margin-bottom: 30px;
    }

    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-group input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .input-group input:focus {
        border-color: #0E8AA9;
        outline: none;
        box-shadow: 0 0 5px rgba(14, 138, 169, 0.2);
    }

    .btn {
        width: 100%;
        background: linear-gradient(to right, #0E8AA9, #3CC1E2);
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.3s ease, transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn:hover {
        background: linear-gradient(to right, #3CC1E2, #0E8AA9);
        transform: translateY(-2px);
    }

    .forgot-password {
        display: inline-block;
        margin-top: 10px;
        font-size: 12px;
        color: #0E8AA9;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    /* Image Section */
    .login-image {
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to right, #0E8AA9, #3CC1E2, #A5BABF);
        padding: 20px;
    }

    .login-image img {
        width: 100%;
        max-width: 450px;
        height: auto;
    }

    @media (max-width: 768px) {
        .login-container {
            grid-template-columns: 1fr; /* Kolom tunggal pada layar kecil */
        }

        .login-image {
            display: none; /* Sembunyikan gambar pada perangkat kecil */
        }
    }
</style>

<div class="login-container">
    <!-- Kolom Form Login -->
    <div class="login-form">
        <h1>Tracer<span>Study</span></h1>
        <h2>SIGN IN</h2>
        <p>Sign in to continue to complete the questionnaire</p>
        <form method="POST" action="{{ route('post.login') }}">
            @csrf
            <div class="input-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Username" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check text-start mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>
            <button type="submit" class="btn">Sign In</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>
    </div>
    <!-- Kolom Gambar -->
    <div class="login-image">
        <img src="{{ asset('image/login.jpg') }}" alt="Login Illustration">
    </div>
</div>
@endsection
