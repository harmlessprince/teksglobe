@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">All Members</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Member type</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->admin == true)
                                                <p class="text-success"> Admin</p>
                                            @else
                                                <p class="text-danger"> Member</p>
                                            @endif
                                        </td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>
                                            @if ($user->active == true)
                                                <p class="text-success"> Active</p>
                                            @else
                                                <p class="text-danger"> Inactive</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->active == true)
                                                <form action="{{ route('admin.membership.update', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" value="0" name="active">
                                                    <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.membership.update', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" value="1" name="active">
                                                    <button type="submit" class="btn btn-sm btn-success"> Activate</button>
                                                </form>
                                            @endif
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
