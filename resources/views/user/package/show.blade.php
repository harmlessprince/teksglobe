@extends('layouts.app')
@push('css')

<style>
.text-custom{
        color: #0E0C28 !important;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block text-center">
                <h3 class="section-title"></p>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body" style="margin-bottom: 0">
                    <h3 class="card-title"> <strong class="text-custom">&#8358;{{ number_format($package->amount, 2) }}</strong></h3>

                    <p class="card-text "> This Plan has the following Benefits. You will get Return <strong class="text-custom">{{ $package->interest }}% </strong> money on every investment. This is <strong class="text-custom"> {{ $package->name }} </strong> Plan.</p>
                    <form method="post" class="" action="{{ route('user.investments.store', $package->id) }}">
                        @csrf
                        <input type="hidden" name="gateway" value="wallet">
                        <button type="submit" class="btn btn-success btn-lg">Buy from Wallet</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body " style="margin-bottom: 0">
                    <h3 class="card-title"> <strong class="text-custom">&#8358;{{ number_format($package->amount, 2) }}</strong></h3>

                    <p class="card-text "> This Plan has the following Benefits. You will get Return <strong class="text-custom">{{ $package->interest }}% </strong> money on every investment. This is <strong class="text-custom"> {{ $package->name }} </strong> Plan.</p>
                    <form method="post" class="" action="{{ route('user.investments.store', $package->id) }}">
                        @csrf
                        <input type="hidden" name="gateway" value="paystack">
                        <button type="submit" class="btn btn-success btn-lg">Pay Online</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body " style="margin-bottom: 0">
                    <h3 class="card-title"> <strong class="text-custom">&#8358;{{ number_format($package->amount, 2) }}</strong></h3>

                    <p class="card-text "> This Plan has the following Benefits. You will get Return <strong class="text-custom">{{ $package->interest }}% </strong> money on every investment. This is <strong class="text-custom"> {{ $package->name }} </strong> Plan.</p>


                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#bankTransferModal">Bank Transfer</a>

                </div>
            </div>
        </div>
    </div>

    {{-- BANK TRNSFER MODAL --}}
    <div class="modal fade" id="bankTransferModal" tabindex="-1" role="dialog" aria-labelledby="bankTransferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankTransferModalLabel">Bank Transfer</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <form method="post" class="my-4" action="{{ route('user.investments.store', $package->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Payment/transfer can also be made into {{ config('app.name') }}'s bank account below. When done with payment, kindly fill the form below with screenshot of teller or successful transfer transaction for us to credit your account. FCMB 0658482020</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Depositor's Name</label>
                                    <input id="name" type="text" required class="form-control form-control-lg" name="name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Amount</label>
                                    <input id="amount" type="number" required value="{{ $package->amount }}" readonly class="form-control form-control-lg" name="amount">
                                    @error('amount')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="evidence" class="col-form-label">Evidence</label>
                                    <input id="evidence" type="file" required class="form-control form-control-lg" name="evidence">
                                    @error('evidence')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="gateway" value="bank">
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
