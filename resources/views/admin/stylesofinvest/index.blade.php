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
                <h5 class="card-header">Investment Styles</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Hours</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if (count($styles) > 0)
                                    @foreach ($styles as $style)
                                        <tr>
                                        <td>{{++$loop->index}}</td>
                                            <td>{{ $style->name }}</td>
                                            <td>{{ $style->compound }}</td>
                                            <td>

                                                <a href="#" class="btn btn-success mr-5"><i class="far fa-edit"></i></a>
                                                <a href="#" class="btn btn-secondary"><i class="fas fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach


                                @else

                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Hours</th>
                                    <th>Actions</th>
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
