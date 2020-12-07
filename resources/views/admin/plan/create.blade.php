@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- center aligned media -->
        <!-- ============================================================== -->

        <form method="post" action="{{ route('plan.store') }}">
            @csrf
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
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
                                    <label for="plan_name" class="col-form-label">Investment Plan Name</label>
                                    <input id="plan_name" type="text" value="" class="form-control form-control-lg"
                                        name="plan_name">
                                    @error('plan_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="style" class="col-form-label">Select Style</label>
                                    <select class="form-control form-control-lg" name="style_id">
                                        <option>------select------</option>
                                        @if (count($styles) > 0)
                                            @foreach ($styles as $style)
                                                <option value="{{ $style->id }}">{{ $style->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Please create some investment plans</option>
                                        @endif


                                    </select>
                                    @error('style_id')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum" class="col-form-label">Minimum Investment</label>
                                    <input id="minimum" type="number" value="" class="form-control form-control-lg"
                                        name="minimum" min="0.0000">
                                    @error('minimum')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maximum" class="col-form-label">Maximum Investment</label>
                                    <input id="maximum" type="number" value="" class="form-control form-control-lg"
                                        name="maximum" min="0.0000">
                                    @error('maximum')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="percentage" class="col-form-label">Investment Interest Return (in
                                        Percentage)</label>
                                    <input id="percentage" type="number" value="" class="form-control form-control-lg"
                                        name="percentage" min="0.0000">
                                    @error('percentage')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="repeat" class="col-form-label">Total Repeat (Interest Return
                                        Frequency)</label>
                                    <input id="repeat" type="number" value="" class="form-control form-control-lg"
                                        name="repeat" min="0.0000">
                                    @error('repeat')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="start_duration" class="col-form-label">Invest Start Delay (in Hour)</label>
                                    <input id="start_duration" type="number" value="" class="form-control form-control-lg"
                                        name="start_duration" min="0">
                                    @error('start_duration')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <a href="#" class="btn btn-secondary">Cancle Plan</a>
                            <button type="submit" class="btn btn-success">Create Plan</button>
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
