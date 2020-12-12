@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <div class="card">
        {{-- <div class="card-header text-center"><img class="logo-img"
                src="../assets/images/logo.png" alt="logo"><span class="splash-description">Check your Mail .</span></div>
        --}}
        <div class="card-body">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Your account has been successfully created but not active yet, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4  text-success">
                    {{ __('Verification Link has been resent') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <div class="form-group"><button class="btn btn-block btn-primary btn-xl">
                                {{ __('Resend Verification Email') }}</button></div>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="btn btn-danger btn-md">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection



{{-- @extends('layouts.app')

@section('content')
    <div class="card-body">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </div>
@endsection --}}
