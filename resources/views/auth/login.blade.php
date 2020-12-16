
@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="card ">
        <div class="card-header text-center">
            <p>Sigin to your Account</p>
            @if ($errors->any())
                <span class="text-danger">Whoops! Something went wrong.</span>
            @endif
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input class="form-control form-control-lg" id="email" type="text" placeholder="Email"
                        autocomplete="off" name="email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="password" name="password" type="password"
                        placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label"
                            id="remember_me" name="remember">Remember
                            Me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0  ">
            <div class="card-footer-item card-footer-item-bordered">
                <a href="{{ route('register') }}" class="footer-link">Create An Account</a>
            </div>
            <div class="card-footer-item card-footer-item-bordered">
                @if (Route::has('password.request'))
                    <a class="footer-link" href="{{ route('password.request') }}">
                        Forgot Password
                    </a>
                @endif
                <!-- <a href="{{ route('password.request') }}" class="footer-link">Forgot Password</a> -->
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layouts.auth')

@section('content')
    <h4>Login</h4>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>
        <a href="{{ route('password.request') }}">Forgot Password</a>
        <button>Login</button>
    </form>
@endsection --}}
