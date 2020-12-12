@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

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
                            <a href="javascript:void(0)" class="btn btn-xs btn-primary">{{ $investment->badge }}</a>
                        </div>
                    </div>
                    <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                    <div class="user-avatar-address">
                        <p class="border-bottom pb-3">
                            <span class="d-xl-inline-block d-block mb-2"><i class="far fa-money-bill-alt mr-2 text-primary"></i>Invested Amount: {{ number_format($investment->amount, 2) }}</span>
                            <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar-alt mr-2 text-primary"></i>Invested Date: {{ $investment->verified_at->format('d M, Y H:i A') }}</span>
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

        <div class="card">
            <h5 class="card-header">Weekly Interests</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Amount</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investment->interests as $interest)
                                <tr>
                                    <td> {{ $interest->created_at->format('d M, Y H:i A') }}</td>
                                    <td>{{ number_format($interest->amount, 2) }}</td>
                                    <td>{{ number_format($interest->balance, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
