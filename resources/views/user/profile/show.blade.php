@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <form method="post" action="" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="icon-box-sm card-header" style="display: flex; align-items: center;">
                        <i class="fas fa-user fa-fw fa-sm text-primary mr-3"></i>
                        <h5 class=" mb-0">My Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12 text-center">
                        <img src="{{ $user->avatar }}" class="profile__image" alt="profile picture">
                        </div>
                        <div class="col-12 text-center mt-3">
                            <span class="input__filespan btn btn-rounded btn-brand">
                                <input type="file" class="avatar_input" name="avatar">
                                <span class="avatar__span">Select image</span>
                            </span>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Full Name</label>
                                    <input id="name" type="text" placeholder="name" class="form-control form-control-lg" name="name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback  d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email Address</label>
                                    <input id="email" type="text" readonly value="{{ $user->email }}" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile" class="col-form-label">Mobile Number</label>
                                    <input id="mobile" type="number" value="{{ $user->mobile }}" class="form-control form-control-lg" name="mobile" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address</label>
                                    <input id="address" type="text" value="{{ $user->address }}" class="form-control form-control-lg" name="address">
                                    @error('address')
                                        <span class="invalid-feedback  d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city" class="col-form-label">City</label>
                                    <input id="city" type="text" value="{{ $user->city }}" class="form-control form-control-lg" name="city">
                                    @error('city')
                                        <span class="invalid-feedback  d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state" class="col-form-label">State</label>
                                    <input id="state" type="text" value="{{ $user->state }}" class="form-control form-control-lg" name="state">
                                    @error('state')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country" class="col-form-label">Country</label>
                                    <input id="country" type="text" value="{{ $user->country }}" class="form-control form-control-lg" name="country">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="current_password" class="col-form-label">Current password</label>
                                    <input id="current_password" type="password" value=""
                                        class="form-control form-control-lg" name="current_password">
                                    <span class="text-danger  text-center d-block">Type your current password to save changes</span>
                                </div>
                            </div>
                            <div class="col-12 card-action">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card" style="display: flex; justify-content: space-around;">
                <div class=" icon-box-sm card-header" style="display: flex; align-items: center;">
                    <i class="fas fa-clipboard-check fa-fw fa-sm text-danger mr-3"></i>
                    <h5 class=" mb-0">KYC Verify Status</h5>
                </div>
                <div class="card-body">
                    <div class="col-12 text-center">
                        <div class=" icon-box-sm mb-4 kyc_verify">

                            <h3 class=" mb-0">Identity Verify:</h3>
                            <a href="#" class="btn btn-danger">
                                <i class="fas fa-times fa-fw fa-lg" style="font-size: 30px"></i>
                            </a>
                        </div>
                        <div class=" icon-box-sm kyc_verify">

                            <h3 class=" mb-0">Address Verify:</h3>
                            <a href="#" class="btn btn-danger">
                                <i class="fas fa-times fa-fw fa-lg" style="font-size: 30px"></i>
                            </a>

                        </div>
                        <a href="#" type="submit" class="btn btn-success mt-5">Submit verification</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

