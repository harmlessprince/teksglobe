@extends('layouts.app')

@push('css')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <transfer-component confirm-url="{{ route('user.transfers.confirm') }}" transfer-url="{{ route('user.transfers.store') }}" pin-url="{{ route('user.pin.index') }}" :pin-status="{{ $pin }}"></transfer-component>
    </div>
@endsection
