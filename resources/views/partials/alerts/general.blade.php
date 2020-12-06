@if (Route::current()->getName() === 'admindb')
    @can('isAdmin')
        <!-- ============================================================== -->
        <!-- Alert  for Admin Users Starts here -->
        <!-- ============================================================== -->

        <div class="row" style="margin-top: 20px;">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="card bg-secondary" style="color: #FFF">
                    <div class="icon-circle-medium  icon-box-lg  warning-bell">
                        <i class="fas fa-bell fa-fw fa-sm text-primary animated swing"></i>
                    </div>
                    <div class="card-body text-center" style="padding-top: 30px">
                        <p>Hi Taofeeq Adewuyi !!</p>

                        <p>
                            You have received some requests from Investors. Kindly Attend to them
                        </p>
                        <p>
                            The System has 13 Local Deposit Request from an investor.
                        </p>
                        <p>
                            The System has 14 Withdraw Request from an investor.
                        </p>
                        <p>
                            The System has detected 0 investment completed.
                        </p>
                        <p>
                            <a href="{{ route('profile.show', auth()->user()->id) }}" class="btn btn-warning active">Edit profile</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else

    <!-- ============================================================== -->
    <!-- lert  for All Admin  ends here -->
    <!-- ============================================================== -->
    @endcan

@else

    <!-- ============================================================== -->
    <!-- Alert  for All Users Starts here -->
    <!-- ============================================================== -->

    <div class="row" style="margin-top: 20px;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <div class="card bg-primary" style="color: #FFF">
                <div class="icon-circle-medium  icon-box-lg  warning-bell">
                    <i class="fas fa-bell fa-fw fa-sm text-primary animated swing"></i>
                </div>
                <div class="card-body" style="padding-top: 30px">
                    <p>Hi Taofeeq Adewuyi</p>

                    <p>
                        Thanks for using our service. Our System Detect That your identity has not been
                        verified yet. Please note you can't withdraw your earning money without identity
                        verify. Also our some cool features has been disabled for you. So, verify your
                        identity as soon as possible.
                    </p>
                    <p>
                        If you want to verify your identity now then that will be your good decision. For
                        verify your identity click the <b> "EDIT PROFILE"</b> button below. Then update
                        profile with
                        your real information and save. Now click <b>"SUBMIT VERIFICATION"</b> Button in
                        right side
                        and do as our system say.
                    </p>
                    <p>
                        <a href="{{ route('profile.show', auth()->user()->id) }}" class="btn btn-warning active">Edit profile</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- lert  for All Users  ends here -->
    <!-- ============================================================== -->

@endif
