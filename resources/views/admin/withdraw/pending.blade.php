@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Pending Withdrawals</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Charge</th>
                                    <th>Requested</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Decline</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_withdrawals as $pending_withdrawal)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $pending_withdrawal->user->name }}</td>
                                        <td>{{ number_format($pending_withdrawal->amount, 2) }}</td>
                                        <td>{{ number_format($pending_withdrawal->charge, 2) }}</td>
                                        <td> {{ $pending_withdrawal->created_at->format('d M, Y H:i A') }}</td>
                                        <td>
                                            <p class="text-warning"> {{ $pending_withdrawal->status }} </p>
                                        </td>
                                        <td>
                                            <form method="post" class="my-4"
                                                action="{{ route('admin.withdraw.update', $pending_withdrawal->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" class="my-4"
                                                action="{{ route('admin.withdrawals.destroy', $pending_withdrawal->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="declined">
                                                <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                            </form>
                                        </td>
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
