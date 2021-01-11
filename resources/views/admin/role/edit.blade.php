@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">

@endpush
@section('pageheader')
    Update Role
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('admin.role.update', $role->id) }}" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input id="name" type="text" class="form-control form-control-lg" name="name" required
                                        placeholder="Enter role name" value="{{$role->name}}">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mb-4">Permissions:</h4>
                                    </div>
                                    @error('permissions')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @error('permissions.*')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>Invalid permission supplied</strong>
                                        </span>
                                    @enderror
                                    @forelse ($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="" name="permissions[]"
                                                    value="{{ $permission->id }}" @if ($role->permissions->contains($permission))
                                                        checked
                                                    @endif>
                                                <label class="form-check-label" for="permissions[]">
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
                            <div class="col-12 mt-2 card-action">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endpush
