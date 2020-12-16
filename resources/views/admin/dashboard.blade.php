@extends('layouts.app')

@section('content')
    {{-- <div class="row" style="margin-top: 20px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="card bg-secondary" style="color: #FFF">
                <div class="icon-circle-medium  icon-box-lg  warning-bell">
                    <i class="fas fa-bell fa-fw fa-sm text-primary animated swing"></i>
                </div>
                <div class="card-body text-center" style="padding-top: 30px">
                    <p>Hi Taofeeq Adewuyi !!</p>

                    <p>
                        You have received some requests from Investors. Kindly Attend to them
                    </p>
                    <p>
                        The System has 13 Local Deposit Request from an investor.
                    </p>
                    <p>
                        The System has 14 Withdraw Request from an investor.
                    </p>
                    <p>
                        The System has detected 0 investment completed.
                    </p>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">Total Investments</h6>
                        <h2 class="mb-0">{{ number_format($investments) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                        <i class="fa fa-money-bill-alt fa-fw fa-sm text-brand"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">Total Users</h6>
                        <h2 class="mb-0">{{ number_format($users) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">New Loans</h6>
                        <h2 class="mb-0">{{ number_format($loans) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fa fa-eye fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">Pending Withdrawals</h6>
                        <h2 class="mb-0">{{ number_format($withdraws) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-secondary-light mt-1">
                        <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
