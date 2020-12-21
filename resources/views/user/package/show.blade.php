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
            <div class="card">
                <h5 class="card-header"></h5>
                <div class="card-body">
                    <h2 class="mb-3">{{ $package->name }} Plan</h2>
                    <h3 class="mb-0 text-primary">&#8358;{{ number_format($package->amount, 2) }}</h3>
                    <section class="my-2">
                        <p>This {{ $package->name }} plan has a weekly return of <strong class="text-custom">{{ $package->interest }}% </strong> for <strong class="text-custom">50 weeks</strong> and has an incubation period of <strong class="text-custom">30 days</strong>. Weekly interests are paid straight into your wallet every Friday.</p>
                    </section>
                    <hr>
                    <section class="my-2">
                        <h3 class="mb-3">Available Payment Methods</h3>
                        <section class="my-2">
                            <h5 class="mb-1"> - <u>Online Payment</u></h5>
                            <p>Pay using your ATM card on our secured payment gateway platform</p>
                            <form method="post" class="" action="{{ route('user.investments.store', $package->id) }}">
                                @csrf
                                <input type="hidden" name="gateway" value="paystack">
                                <button type="submit" class="btn btn-primary">Pay Online</button>
                            </form>
                        </section>
                        <section class="my-2">
                            <h5 class="mb-1"> - <u>Wallet Payment</u></h5>
                            <p>Pay using your ATM card on our secured payment gateway platform</p>
                            <form method="post" class="" action="{{ route('user.investments.store', $package->id) }}">
                                @csrf
                                <input type="hidden" name="gateway" value="wallet">
                                <button type="submit" class="btn btn-primary">Buy from Wallet</button>
                            </form>
                        </section>
                        <section class="my-2">
                            <h5 class="mb-1"> - <u>Bank Payment</u></h5>
                            <p>Payment/transfer can also be made into {{ config('app.name') }}'s bank account below. When done with payment, click the button below and kindly fill the form below with screenshot of teller or successful transfer transaction for us to credit your account. FCMB 0658482020333</p>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#bankTransferModal">Bank Payment</a>
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- BANK TRNSFER MODAL --}}
    <div class="modal fade" id="bankTransferModal" tabindex="-1" role="dialog" aria-labelledby="bankTransferModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankTransferModalLabel">Bank Payment</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <form method="post" class="my-4" action="{{ route('user.investments.store', $package->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p>Payment/transfer can also be made into {{ config('app.name') }}'s bank account below. When done with payment, kindly fill the form below with screenshot of teller or successful transfer transaction for us to credit your account. FCMB 0658482020333</p>
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
                                    <label for="evidence" class="col-form-label">Evidence (Not more than 150KB and should be in JPEG, JPG or PNG format)</label>
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
