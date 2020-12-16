@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">

@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Packages</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th >Name</th>
                                    <th>Amount</th>
                                    <th width="25">Returns</th>
                                    <th width="25">Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ number_format($package->amount, 2) }}</td>
                                        <td>{{ number_format($package->returns, 2) }}</td>
                                        <td>
                                            @if ($package->status == 1)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Not Active</span>
                                            @endif
                                        </td>
                                        <td> {{ $package->created_at->format('d M, Y H:i A') }}</td>
                                        <td>
                                            {{-- <form action="{{ route('admin.packages.destroy', $package->id) }}"
                                                method="post" class="d-inline mr-2">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form> --}}
                                            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-warning ">Edit</a>
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
