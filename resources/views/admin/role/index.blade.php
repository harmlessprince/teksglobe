@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Declined Investments</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($investments as $investment)
                                    <tr>
                                        <td>{{ $investment->user->name }}</td>
                                        <td>{{ $investment->package->name }}</td>
                                        <td>{{ number_format($investment->amount, 2) }}</td>
                                        <td>{{ number_format($investment->balance, 2) }}</td>
                                        <td> {{ $investment->created_at->format('d M, Y H:i A') }}</td>
                                        <td>
                                            <a href="#" class="card-link text-danger">Declined</a>
                                        </td>
                                       
                                        {{-- <td>
                                            <form method="post" class="my-4" action="{{ route('admin.investments.update', $investment->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form method="post" class="my-4" action="{{ route('admin.investments.update', $investment->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="btn btn-warning btn-sm">Pend it</button>
                                            </form>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </tfoot>
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
