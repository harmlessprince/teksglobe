@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ route('user.pin.update') }}">
                @csrf
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;">{{ $pin ? 'Update' : 'Create' }} Pin</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if ($pin)
                                    <div class="form-group">
                                        <label for="current_pin" class="col-form-label">Current Pin</label>
                                        <input id="current_pin" type="password" maxlength="4" class="form-control form-control-lg" name="current_pin" required>
                                        @error('current_pin')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="pin" class="col-form-label">New Pin</label>
                                    <input id="pin" type="password" maxlength="4" class="form-control form-control-lg" name="pin" required>
                                    @error('pin')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pin_confirmation" class="col-form-label">Confirm Pin</label>
                                    <input id="pin_confirmation" type="password" maxlength="4" class="form-control form-control-lg" name="pin_confirmation" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input id="password" type="password" class="form-control form-control-lg" name="password">
                                    @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-2 card-action">
                                <button type="submit" class="btn btn-primary">{{ $pin ? 'Update' : 'Create' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

