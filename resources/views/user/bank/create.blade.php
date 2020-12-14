@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('user.banks.store') }}">
                @csrf
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;">Bank Account</h5>
                    </div>
                    <div class="card-body">
                        <p>Note: This can be done once. For futher change reach out to customer support</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bank" class="col-form-label">Bank</label>
                                    <input id="bank" type="text" value="{{ old('bank', optional($bank)->bank_name) }}" class="form-control form-control-lg" name="bank" required>
                                    @error('bank')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Account Name</label>
                                    <input id="name" type="text" value="{{ old('name', optional($bank)->account_name) }}" class="form-control form-control-lg" name="name" required>
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="number" class="col-form-label">Account Number</label>
                                    <input id="number" type="number" value="{{ old('number', optional($bank)->account_number) }}" class="form-control form-control-lg" name="number" required>
                                    @error('number')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if (!$bank)
                                <div class="col-12 mt-2 card-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
