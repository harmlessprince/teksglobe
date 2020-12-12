
@extends('layouts.auth')
@section('title', 'Forgot password')
@section('content')
    <div class="card">
        <div class="card-header text-center"><span
                class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">
            <form  method="POST" action="{{ route('password.email') }}">
                @csrf
                <p>Don't worry, we'll send you an email to reset your password.</p>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" :value="old('email')" required=""
                        placeholder="Your Email" autocomplete="off" autofocus>
                </div>
                <div class="form-group pt-1"><button class="btn btn-block btn-primary btn-xl" >Reset
                        Password</button></div>
            </form>
        </div>
        <div class="card-footer text-center">
            <span>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></span>
        </div>
    </div>
@endsection
{{-- @extends('layouts.auth')

@section('content')
    <h4>Forgot Password</h4>
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <button>Send Reset Mail</button>
    </form>
@endsection --}}
