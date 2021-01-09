@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">My Investments</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Amount Invested</th>
                                    <th>Expected Returns</th>
                                    <th>Current Returns</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investments as $investment)
                                    <tr>
                                        <td>
                                            @php
                                                $badge = $investment->badge;
                                            @endphp
                                            <span class="badge-dot badge-{{ $badge['color'] }}"></span>
                                        </td>
                                        <td>{{ $badge['text'] }}</td>
                                        <td>{{ $investment->package->name }}</td>
                                        <td>{{ number_format($investment->amount, 2) }}</td>
                                        <td>{{ number_format($investment->returns, 2) }}</td>
                                        <td>{{ number_format($investment->interests, 2) }}</td>
                                        <td> {{ optional($investment->verified_at)->format('d M, Y H:i A') }}</td>
                                        <td><a href="{{ route('user.investments.show', $investment->id) }}" class="card-link">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
