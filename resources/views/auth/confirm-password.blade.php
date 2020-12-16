@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-12 mx-auto">
            <form method="post" action="{{ url('/user/confirm-password') }}" autocomplete="off">
                @csrf
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;">Confirm Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input id="password" type="password" class="form-control form-control-lg" name="password" required autocomplete="one-time-code">
                                    @error('password')
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
