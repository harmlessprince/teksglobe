@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card influencer-profile-data">
            <div class="card-body">
                <div class="user-avatar-info">
                    <div class="m-b-20">
                        <div class="user-avatar-name">
                            <h2 class="mb-1">{{ $investment->package->name }}</h2>
                        </div>
                        <div class="rating-star p-0 d-inline-block">
                            <a href="javascript:void(0)" class="btn btn-xs btn-primary">{{ ($investment->balance > 0) ? 'Running' : 'Completed' }}</a>
                        </div>
                    </div>
                    <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                    <div class="user-avatar-address">
                        <p class="border-bottom pb-3">
                            <span class="d-xl-inline-block d-block mb-2"><i class="far fa-money-bill-alt mr-2 text-primary"></i>Invested Amount: {{ number_format($investment->amount, 2) }}</span>
                            <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar-alt mr-2 text-primary"></i>Invested Date: {{ $investment->created_at->format('d M, Y H:i A') }}</span>
                            <span class="mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-piggy-bank mr-2 text-primary"></i>Interest Rate: 4%
                            </span>
                            <span class="mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-chart-line mr-2 text-primary"></i>Interest Gained: {{ number_format($investment->interests->sum('amount'), 2) }}</span>
                        </p>
                        <div class="mt-3">
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: {{ $investment->completion }}%;" aria-valuenow="{{ $investment->completion }}" aria-valuemin="0" aria-valuemax="{{ $investment->total }}">{{ $investment->completion }}%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
