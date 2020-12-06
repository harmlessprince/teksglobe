@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            @include('components.navbarbrand')
            <span class="splash-description">Please enter your user information.</span>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <label for="email" class="col-form-label">Email</label>
                    <input id="email" type="text" :value="old('email', $request->email)"
                        class="form-control form-control-lg" name="email">
                    @error('email')
                        <span class="invalid-feedback  d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="password" class="col-form-label">Password</label>
                    <input id="password" type="text" class="form-control form-control-lg" name="password"
                        autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback  d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                    <input id="password_confirmation" type="text" class="form-control form-control-lg"
                        name="password_confirmation" autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback  d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group pt-1"><button class="btn btn-block btn-primary btn-xl">
                        {{ __('Reset Password') }}</button></div>

            </form>
        </div>
    </div>
@endsection


{{-- @extends('layouts.auth')

@section('content')
    <h4>Reset Password</h4>
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" readonly value="{{ old('email', $request->email) }}">
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
        <button>Reset Password</button>
    </form>
@endsection --}}
