@extends('layouts.app')

@push('css')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <withdraw-component withdraw-url="{{ route('user.withdraws.store') }}" :withdraw-status="{{ $bank }}" profile-url="{{ route('user.profile.show') }}" pin-url="{{ route('user.pin.index') }}" :pin-status="{{ $pin }}"></withdraw-component>
    </div>
@endsection
