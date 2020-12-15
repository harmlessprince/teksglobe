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
                            @php
                                $badge = $investment->badge;
                            @endphp
                            <a href="javascript:void(0)" class="btn btn-sm btn-{{ $badge['color'] }}">{{ $badge['text'] }}</a>
                        </div>
                    </div>
                    <div class="user-avatar-address">
                        <p class="border-bottom pb-3">
                            <span class="d-xl-inline-block d-block mb-2"><i class="far fa-money-bill-alt mr-2 text-primary"></i>Invested Amount: {{ number_format($investment->amount, 2) }}</span>
                            <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><i class="fa fa-calendar-alt mr-2 text-primary"></i>Invested Date: {{ $investment->verified_at->format('d M, Y H:i A') }}</span>
                            <span class="mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-piggy-bank mr-2 text-primary"></i>Interest Rate: 4%
                            </span>
                            <span class="mb-2 d-xl-inline-block d-block ml-xl-4"><i class="fas fa-chart-line mr-2 text-primary"></i>Interest Gained: {{ number_format($investment->interests->sum('amount'), 2) }}</span>
                        </p>
                        <div class="mt-3 text-center">
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" style="width: {{ $investment->completion }}%;" aria-valuenow="{{ $investment->completion }}" aria-valuemin="0" aria-valuemax="{{ $investment->total }}">{{ $investment->completion }}%</div>
                            </div>
                            @if (!$investment->hasActiveLoan())
                                <a href="#" data-toggle="modal" data-target="#loanModal" class="btn btn-primary">Apply for Loan</a>
                            @endif
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

    {{-- LAON CONFIRMATION MODAL --}}
    <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loanModalLabel">Modal title</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </a>
                </div>
                <form method="post" class="my-4" action="{{ route('user.loans.store', $investment->id) }}">
                    @csrf
                    <div class="modal-body">
                        <p>Woohoo, You are readng this text in a modal! Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content.</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary btn-lg">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
