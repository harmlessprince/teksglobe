@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('user.withdraws.store') }}">
                @csrf
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;">Withdraw</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Amount</label>
                                    <input id="amount" type="number" value="{{ old('amount') }}" class="form-control form-control-lg" name="amount">
                                    @error('amount')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pin" class="col-form-label">Pin</label>
                                    <input id="pin" type="text" value="" class="form-control form-control-lg" name="pin">
                                    @error('pin')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
