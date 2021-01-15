@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Declined Withdrawals</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Charge</th>
                                    <th>Account</th>
                                    <th>Requested</th>
                                   
                                    <th>Status</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($declined_withdrawals as $declined_withdrawal)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                    <td>{{$declined_withdrawal->user->name}}</td>
                                        <td>{{ number_format($declined_withdrawal->amount, 2) }}</td>
                                        <td>{{ number_format($declined_withdrawal->charge, 2) }}</td>
                                        <td>---</td>
                                        <td> {{ $declined_withdrawal->verified_at->format('d M, Y H:i A') }}</td>
                                        <td> <p class="text-success">{{ $declined_withdrawal->status }}</p></td>
                                        {{-- <td>
                                            <form action="{{ route('admin.withdrawals.update', $declined_withdrawal->id) }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-primary btn-sm">Re-activate</button>
                                            </form>
                                            <form action="{{ route('admin.withdrawals.update', $declined_withdrawal->id) }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-primary btn-sm">Re-activate</button>
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
