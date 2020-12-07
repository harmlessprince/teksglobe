@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- center aligned media -->
        <!-- ============================================================== -->

        <form method="post" action="{{ route('packages.store') }}">
            @csrf
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-auto">
                <div class="card">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell sidebar-dark">
                        <i class="fas fa-dolly fa-fw fa-sm text-primary"></i>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0" style="margin-left: 4rem;"> Invest Plan Section - Create Invest Plan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Package Name</label>
                                    <input id="name" type="text" value="" class="form-control form-control-lg"
                                        name="name">
                                    @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Package Amount</label>
                                    <input id="amount" type="text" value="" class="form-control form-control-lg"
                                        name="amount">
                                    @error('amount')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interest" class="col-form-label">Investment Interest Return (in
                                        Percentage)</label>
                                    <input id="interest" type="number" value="" class="form-control form-control-lg"
                                        name="interest" min="0.0000">
                                    @error('interest')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="col-form-label">Select Plan Status</label>
                                    <select class="form-control form-control-lg" name="status">
                                        <option>------select------</option>
                                        <option value="1">Active</option>
                                        <option value="0">Not active</option>

                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2 card-action">
                            <a href="#" class="btn btn-secondary">Cancle Package</a>
                            <button type="submit" class="btn btn-success">Create Package</button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
     
        <!-- ============================================================== -->
        <!-- end center aligned media -->
        <!-- ============================================================== -->
    </div>
@endsection
