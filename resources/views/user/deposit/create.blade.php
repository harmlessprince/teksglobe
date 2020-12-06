@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- center aligned media -->
        <!-- ============================================================== -->
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">

            <div class="card">
                <div class=" icon-box-sm card-header" style="display: flex; align-items: center;">
                    <i class="fas fa-user fa-fw fa-sm text-primary mr-3"></i>
                    <h5 class=" mb-0">Deposit section</h5>
                </div>

                <div class="card-body">


                    <div class="col-12 card-action">
                        <a href="#" class="btn btn-secondary">Cancle Deposit</a>
                        <button type="submit" class="btn btn-success">Deposit Now</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- ============================================================== -->
        <!-- end center aligned media -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- bootom aligne media -->
        <!-- ============================================================== -->
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card" style="display: flex; justify-content: space-around;">
                <div class=" icon-box-sm card-header" style="display: flex; align-items: center;">
                    <i class="fas fa-clipboard-check fa-fw fa-sm text-danger mr-3"></i>
                    <h5 class=" mb-0">Deposit Balance</h5>
                </div>
                <div class="card-body">

                    <a href="#" type="submit" class="btn btn-success mt-5">Submit verification</a>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end bootom aligne media -->
        <!-- ============================================================== -->
    </div>
@endsection
