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
                    <h4 class="card-header-title">Add User(s)</h4>
                    <div class="toolbar ml-auto">

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.role.add', $role->id) }}" method="POST">
                                @csrf
                            <div class="form-group">
                                <select class="form-control form-control-lg users" name="users[]" multiple="multiple"
                                 >
                                    <option>Select User</option>
                                    @forelse ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @empty
                                        <option>No user in the system</option>
                                    @endforelse
                                </select>
                                @error('users')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <button class="btn btn-primary btn-sm ">Add Selected</button>
                        </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-header-title">Users in {{ $role->name }}</h4>
                </div>
                <form action="{{ route('admin.role.remove', $role->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th width="30"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th width="200">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($role->users as $user)
                                        <tr>

                                            <td class="text-center">
                                                <input type="checkbox" class="" name="members[]"  value="{{ $user->id }}"
                                                id="user-{{ $user->id }}" @if(old('users') && in_array($user->id, old('users'))) checked @endif >
                                            </td>
                                            <td>{{ $user->name ?? '' }}</td>
                                            <td>{{ $user->email ?? '' }}</td>
                                            <td> {{ $user->created_at->format('d M, Y H:i A') ?? '' }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">Remove Selected</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
    {{-- <script
        src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    --}}
    <script>
        $(document).ready(function() {
            $('.users').select2();
        });

    </script>
@endpush
