@extends('layouts.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card"> 
                <div class="card-header d-flex">
                    <h4 class="card-header-title">Users in {{ $role->name }}</h4>
                    <div class="toolbar ml-auto">
                        <a href="{{route('admin.role.assign', $role->id)}}" class="btn btn-primary btn-sm ">Edit</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th width="30">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th width="200">Created at</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($role->users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $user->name ?? '' }}</td>
                                        <td>{{ $user->email ?? '' }}</td>
                                        <td> {{ $user->created_at->format('d M, Y H:i A') ?? '' }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                
                <div class="card-header d-flex">
                    <h4 class="card-header-title">Permission List</h4>
                    <div class="toolbar ml-auto">
                        <a href="{{route('admin.role.edit', $role->id)}}" class="btn btn-primary btn-sm ">Edit Permissions</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @forelse ($role->permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="" checked>
                                            <label class="form-check-label" for="">
                                                <h4 class="text-uppercase">
                                                    {{ $permission->name }}
                                                </h4>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <h2>No Permissions has been created yet</h2>
                                @endforelse
                            </div>
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush
