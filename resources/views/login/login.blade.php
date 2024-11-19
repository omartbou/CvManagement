<style>
    body, html {
        height: 100%;
        margin: 0;
        background-color: #f8f9fa;
    }
    .login-container {
        display: flex;
        height: 100%;
    }
    .login-left {
        background: url('{{ asset('images/img.png') }}') no-repeat center center;
        background-size: cover;
        flex: 1;
        position: relative;
    }
    .login-left::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    .login-right {
        flex: 1;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-box {
        width: 100%;
        max-width: 500px;
        padding: 40px;
    }
    .top-logo {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .top-logo img {
        max-width: 100px;
    }
    .form-group {
        margin-bottom: 20px;
    }


</style>
@extends('layout.app')
@section('content')
    <div class="login-container">
        <div class="login-left">

        </div>

        <div class="login-right">
            <div class="login-box">
                <div class="top-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <h2 class="text-center" style="color:#232F68;">Welcome back!</h2>
                <p class="text-center" style="color:#727272;">Please Login to Continue</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" style="color:#232F68;">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email here">
                    </div>
                    <div class="form-group">
                        <label for="password" style="color:#232F68;">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password here">
                    </div>
                    <div class="d-flex justify-content-between">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>

                    </div>
                    <a href="#" class="d-block mb-3" style="color:#232F68;">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-block text-light" style="background: #232F68; width: 100%">Sign In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
