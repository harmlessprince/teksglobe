@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">

@endpush
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Packages</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($packages) > 0)
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->name }}</td>
                                            <td>{{ $package->amount }}</td>
                                            <td>{{ $package->interest }}%</td>
                                            <td>
                                                @if ($package->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Not Active</span>
                                                @endif
                                            </td>

                                            <td> {{ $package->created_at->format('d M, Y H:i A') }}</td>
                                        </tr>
                                    @endforeach

                                @else

                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
