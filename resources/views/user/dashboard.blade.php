@extends('layouts.app')

@section('content')
    {{-- <div class="row" style="margin-top: 20px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="card bg-primary" style="color: #FFF">
                <div class="icon-circle-medium  icon-box-lg  warning-bell">
                    <i class="fas fa-bell fa-fw fa-sm text-primary animated swing"></i>
                </div>
                <div class="card-body" style="padding-top: 30px">
                    <p>Hi Taofeeq Adewuyi</p>

                    <p>
                        Thanks for using our service. Our System Detect That your identity has not been
                        verified yet. Please note you can't withdraw your earning money without identity
                        verify. Also our some cool features has been disabled for you. So, verify your
                        identity as soon as possible.
                    </p>
                    <p>
                        If you want to verify your identity now then that will be your good decision. For
                        verify your identity click the <b> "EDIT PROFILE"</b> button below. Then update
                        profile with
                        your real information and save. Now click <b>"SUBMIT VERIFICATION"</b> Button in
                        right side
                        and do as our system say.
                    </p>
                    <p>
                        <a href="{{ route('user.profile.show', auth()->user()->id) }}" class="btn btn-warning active">Edit profile</a>
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
                        <h6 class="text-muted">Wallet Balance (&#8358;)</h6>
                        <h2 class="mb-0">{{ number_format($balance) }}</h2>
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
                        <h6 class="text-muted">Total Investments (&#8358;)</h6>
                        <h2 class="mb-0">{{ number_format($investments) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                        <i class="fa fa-eye fa-fw fa-sm text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">Outstanding Loans (&#8358;)</h6>
                        <h2 class="mb-0">{{ number_format($loans) }}</h2>
                    </div>
                    <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                        <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-inline-block">
                        <h6 class="text-muted">Pending Withdraws</h6>
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
