@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title"><strong>Confirm Transfer</strong></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 pr-0">
                            <img src="http://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="..." width="100%" style="max-height: 300px">
                        </div>
                        <div class="col-sm-6">
                            <h3 class="font-weight-bold">{{ $account->name }}</h3>
                            <h5 class="font-weight-bold">{{ $email }}</h5>
                            <h5 class="font-weight-bold">Amount To Transfer: {{ number_format($amount, 2) }}</h5>
                            <h5 class="font-weight-bold">Wallet Transfer</h5>
                            <form action="{{ route('user.transfers.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="user" value="{{ $account->id }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <a class="btn btn-primary" href="{{ route('user.transfers.index') }}">Cancel</a>
                                <button class="btn btn-primary">Transfer</button>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
