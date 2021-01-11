@extends('layouts.app')
@section('pageheader')
Create Role
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('admin.role.store') }}" autocomplete="off">
                @csrf
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
                                        placeholder="Enter role name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="row">
                                    @forelse ($permissions as $permission)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="" name="permissions[]"
                                                    value="{{ $permission->id }}">
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
