@extends('layouts.app')

@section('content')
    <h2>My Investments</h2>
    @foreach ($investments as $investment)
        <h4>{{ $investment->package->name }}</h4>
        <h6>{{ $investment->amount }}</h6>
        <h6>{{ $investment->created_at->format('d M, Y H:i A') }}</h6>
    @endforeach
@endsection
