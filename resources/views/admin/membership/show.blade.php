@extends('layouts.app')
@section('title', 'Profile')
@section('pageheader', $user->name)

@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- center aligned media -->
        <!-- ============================================================== -->
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto">



            <div class="mb-5" style="display: flex">

                <img src="{{ url($user->avatar) }}" class="profile__image mr-5" alt="profile picture">
                <div>
                    <div>
                        <h4>{{ $user->name }}</h4>
                    </div>
                    <div>
                        <h5> {{ $user->email }}</h5>
                    </div>
                    <div>
                        <h5> {{ $user->mobile }}</h5>
                    </div>
                    <div>
                        <h5 class="{{ $user->active ? 'text-success' : 'text-danger' }}">
                            {{ $user->active ? 'Active' : 'Inactive' }}
                        </h5>
                    </div>
                    <div>
                        <h5> {{ $user->email }}</h5>
                    </div>
                </div>

            </div>

            @if ($user->bank !== null)

                <div class="bank_details">
                    <h4 class="pageheader-title">Bank Details</h4>
                    <div>
                        <h4>Bank name: {{ $user->bank->bank_name ?? '' }}</h4>
                    </div>
                    <div>
                        <h5> Account name: {{ $user->bank->account_name ?? '' }}</h5>
                    </div>
                    <div>
                        <h5> Account number: {{ $user->bank->account_number ?? '' }}</h5>
                    </div>
                </div>


            @endif
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- end center aligned media -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- bootom aligne media -->
    <!-- ============================================================== -->
    {{-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
        <div class="card" style="display: flex; justify-content: space-around;">
            <div class=" icon-box-sm card-header" style="display: flex; align-items: center;">
                <i class="fas fa-clipboard-check fa-fw fa-sm text-danger mr-3"></i>
                <h5 class=" mb-0">KYC Verify Status</h5>
            </div>
            <div class="card-body">
                <div class="col-12 text-center">
                    <div class=" icon-box-sm mb-4 kyc_verify">

                        <h3 class=" mb-0">Identity Verify:</h3>
                        <a href="#" class="btn btn-danger">
                            <i class="fas fa-times fa-fw fa-lg" style="font-size: 30px"></i>
                        </a>
                    </div>
                    <div class=" icon-box-sm kyc_verify">

                        <h3 class=" mb-0">Address Verify:</h3>
                        <a href="#" class="btn btn-danger">
                            <i class="fas fa-times fa-fw fa-lg" style="font-size: 30px"></i>
                        </a>

                    </div>
                    <a href="#" type="submit" class="btn btn-success mt-5">Submit verification</a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- end bootom aligne media -->
    <!-- ============================================================== -->
    </div>
@endsection
