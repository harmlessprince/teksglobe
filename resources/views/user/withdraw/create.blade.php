@extends('layouts.app')

@push('css')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@section('content')
    <div class="row">
        <withdraw-component withdraw-url="{{ route('user.withdraws.store') }}" can-withdraw="{{ $bank }}"></withdraw-component>
    </div>
@endsection
