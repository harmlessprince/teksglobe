@extends('layouts.app')

@section('content')
    <div class="card invoice">
        <div class="card-header p-2 p-md-3 border-bottom-0 bg-gradient-primary-to-secondary text-white-50">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-lg-auto mb-5 mb-lg-0 text-center text-lg-left">
                    <!-- Invoice branding-->
                    <img class="invoice-brand-img rounded-circle mb-4" src="assets/img/logo-invoice.svg" alt />
                    <div class="h3 text-white mb-0">{{ config('app.name') }}</div>
                    <p class="h6">Buy Investment Package</p>
                </div>
                <div class="col-12 col-lg-auto text-center text-lg-right">
                    <!-- Invoice details-->
                    <div class="h4 text-white">Invoice</div>
                    <span class="h6">#{{ str_pad($payment->id, 5, "0", STR_PAD_LEFT) }}</span>
                    <br>
                    <span class="h6">{{ now()->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
        <div class="card-body p-4 p-md-5">
            <!-- Invoice table-->
            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="border-bottom">
                        <tr class="text-uppercase text-muted">
                            <th scope="col">Description</th>
                            <th class="text-right" scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Invoice item 1-->
                        <tr class="border-bottom">
                            <td>
                                <div class="font-weight-bold h5">{{ $package->name }}</div>
                                <div class="text-muted d-none d-md-block">---</div>
                            </td>
                            <td class="text-right h5 font-weight-bold">{{ number_format($payment->amount/100, 2) }}</td>
                        </tr>
                        <!-- Invoice subtotal-->
                        <tr>
                            <td class="text-right pb-0" colspan="1"><div class="text-uppercase font-weight-700 text-muted">Subtotal:</div></td>
                            <td class="text-right pb-0"><div class="h5 mb-0 font-weight-700">{{ number_format($payment->amount/100, 2) }}</div></td>
                        </tr>
                        <!-- Invoice tax column-->
                        <tr>
                            <td class="text-right pb-0" colspan="1"><div class="text-uppercase font-weight-700 text-muted">Tax ({{ ($payment->charge / $payment->amount) * 100 }}%):</div></td>
                            <td class="text-right pb-0"><div class="h5 mb-0 font-weight-700">{{ number_format($payment->charge/100, 2) }}</div></td>
                        </tr>
                        <!-- Invoice total-->
                        <tr>
                            <td class="text-right pb-0" colspan="1"><div class="text-uppercase font-weight-700 text-muted">Total Amount Due:</div></td>
                            <td class="text-right pb-0"><div class="h5 mb-0 font-weight-700 text-green">{{ number_format(($payment->amount + $payment->charge) /100, 2) }}</div></td>
                        </tr>
                        <tr>
                        <td class="text-right pb-0" colspan="2">
                            <div class="">
                                <form action="{{ route('payment.verify') }}" name="paystack-pay" method='POST'>
                                    @csrf
                                    <script
                                        src='https://js.paystack.co/v1/inline.js'
                                        data-key="{{ config('paystack.public') }}"
                                        data-email="{{ auth()->user()->email }}"
                                        data-amount="{{ $payment->amount + $payment->charge }}"
                                        data-ref="{{ $payment->reference }}"
                                    >
                                    </script>
                                </form>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer p-4 p-lg-5 border-top-0">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <!-- Invoice - sent to info-->
                    <div class="text-muted text-uppercase font-weight-700 mb-2">To</div>
                    <div class="h6 mb-1">{{ config('app.name') }}</div>
                    <div class=""></div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <!-- Invoice - sent from info-->
                    <div class="text-muted text-uppercase font-weight-700 mb-2">From</div>
                    <div class="h6 mb-0">{{ auth()->user()->name }}</div>
                    <div class="">{{ auth()->user()->email }}</div>
                </div>
                <div class="col-lg-6">
                    <!-- Invoice - additional notes-->
                    <div class="text-muted text-uppercase font-weight-700 mb-2">Note</div>
                    <div class="mb-0">---</div>
                </div>
            </div>
        </div>
    </div>
@endsection
