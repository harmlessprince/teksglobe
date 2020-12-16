@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="card" style=" ">
            <div class="card-header text-center">
                <span class="splash-description">Please enter your information.</span></div>
            <div class="card-body">
                @if ($errors->any())
                    <span class="text-danger">Whoops! Something went wrong.</span>
                @endif
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="name" required placeholder="Full Name"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="mobile" required
                        placeholder="Phone Number (+23480000001)" autocomplete="off">
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required placeholder="E-mail"
                        autocomplete="off">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="confirmation" type="password" name="password"
                        required placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="password" name="password_confirmation"
                        id="password_confirmation" required placeholder="Confirm">
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating
                            an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                {{-- <div class="form-group row pt-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
                    </div>
                </div> --}}
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="{{ route('login') }}" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
@endsection

{{-- @extends('layouts.auth')

@section('content')
<h4>Register</h4>
<form action="{{ route('register') }}" method="post">
    @csrf
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        @error('name')
        <span>{{ $message }}</span>
        @enderror
    </div>
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
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
    </div>
    <button>Register</button>
</form>
@endsection --}}
