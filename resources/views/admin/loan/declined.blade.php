@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Declined Loans</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Total Payable</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td>
                                            <span
                                                class="badge-dot {{ $loan->status === 'approved' ? 'badge-primary' : 'badge-danger' }}"></span>
                                        </td>
                                        <td>{{ $loan->user->name }}</td>
                                        <td>{{ $loan->created_at->format('d M, Y H:i A') }}</td>
                                        <td>{{ number_format($loan->amount, 2) }}</td>
                                        <td>{{ number_format($loan->charge, 2) }}</td>
                                        <td>{{ number_format($loan->amount + $loan->charge, 2) }}</td>
                                        <td> <p class="text-danger"> {{ $loan->status }}</p></td>
                                        <td>{{ optional($loan->verified_at)->format('d M, Y H:i A') }}</td>
                                        {{-- <td>
                                            <form method="post" class="my-4" action="{{ route('admin.loans.update', $loan->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form method="post" class="my-4" action="{{ route('admin.loans.update', $loan->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="btn btn-danger btn-sm">Pend it</button>
                                            </form>
                                        </td> --}}
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
