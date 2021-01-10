@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h3 class="card-header">Application Roles</h3>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th width="30">#</th>
                                    <th>Role Name</th>
                                    <th width="100">User Count</th>
                                    <th width="200">Created at</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $role->name ?? '' }}</td>
                                        <td>{{ $role->users_count ?? '' }}</td>
                                        <td> {{ $role->created_at->format('d M, Y H:i A') ?? '' }}</td>
                                        <td>
                                            <a href="{{route('admin.role.show', $role->id)}}" class="mr-4" title="View Users In Role">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{route('admin.role.edit', $role->id)}}" class="mr-4" title="Edit Role">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="{{route('admin.role.assign', $role->id)}}" title="Assign Users To Role">
                                                <i class="fas fa-user"></i>
                                            </a>
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
