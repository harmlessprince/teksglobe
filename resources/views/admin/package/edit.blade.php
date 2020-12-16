@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('admin.packages.update', $package->id) }}">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;">Edit Package</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input id="name" type="text" value="{{ $package->name }}" class="form-control form-control-lg" name="name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Amount</label>
                                    <input id="amount" type="number" value="{{ $package->amount }}" class="form-control form-control-lg" name="amount">
                                    @error('amount')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="returns" class="col-form-label">Investment Returns</label>
                                    <input id="returns" type="number" value="{{ $package->returns }}" class="form-control form-control-lg" name="returns" min="1">
                                    @error('returns')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Active Status</label>
                                    <select class="form-control form-control-lg" name="status">
                                        <option value="">--Select--</option>
                                        <option value="1" @if($package->status) selected @endif>Active</option>
                                        <option value="0" @if(!$package->status) selected @endif>Not active</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-2 card-action">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
