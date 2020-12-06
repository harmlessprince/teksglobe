@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
 
@endpush
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Investment Plans</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Minimum</th>
                                    <th>Maximum</th>
                                    <th>Interest</th>
                                    <th>Interest system</th>
                                    <th>Start time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (count($plans) > 0)
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{ $plan->plan_name }}</td>
                                            <td>{{ $plan->style->name }}</td>
                                            <td>{{ $plan->minimum }}</td>
                                            <td> {{ $plan->maximum }}</td>
                                            <td>{{ $plan->percentage }}%</td>
                                            <td>
                                                {{ $plan->style->compound }} hour(s) <br> Later
                                                {{ $plan->repeat }} times
                                            </td>
                                            <td>{{ $plan->start_duration }} hour(s) <br>after invest</td>
                                            <td>
                                                @if ($plan->status == true)
                                                    {{-- <a href="#" class="btn btn-success"> --}}
                                                        {{-- <i class="fas fa-check"></i> --}}
                                                    {{-- </a> --}}
                                                   <p class="text-success"> Active </p>
                                                @else
                                                    {{-- <a href="#" class="btn btn-secondary"> <i class="fas fa-times"></i></a> --}}
                                                    
                                                    <p class="text-danger"> Inactive </p>
                                                @endif

                                            </td>
                                            <td>
                                                
                                                <a href="#" class="btn btn-success"><i class="far fa-edit"></i></a>
                                                <a href="#" class="btn btn-secondary"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else

                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Minimum</th>
                                    <th>Maximum</th>
                                    <th>Interest</th>
                                    <th>Interest system</th>
                                    <th>Start time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
