@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <style>
        .evidence {
            width: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="card">
                <h5 class="card-header">Pending Investments</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Evidence</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investments as $investment)
                                    <tr>
                                        <td>{{ $investment->user->name }}</td>
                                        <td>{{ $investment->package->name }}</td>
                                        <td>
                                            <a href="#" class="text-center pop">
                                                <img src="{{ asset('storage/'.$investment->evidence) }}" alt="evidence" class="user-avatar-md rounded-circle pop">
                                                <input type="hidden" name="invest_id" value="{{ $investment->id }}">
                                            </a>
                                            <div class="modal fade" id="imagemodal-{{ $investment->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="close" data-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span><span
                                                                    class="sr-only">Close</span></button>
                                                            <img src="" class="imagepreview" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($investment->amount, 2) }}</td>
                                        <td>{{ number_format($investment->balance, 2) }}</td>
                                        <td> {{ $investment->created_at->format('d M, Y H:i A') }}</td>
                                        <td>
                                            <a href="#" class="card-link text-warning">Pending</a>
                                        </td>

                                        <td>
                                            <input type="hidden" class="investement_id" value="{{ $investment->id }}">
                                            <form method="post" class="my-4 activate"
                                                action="">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm ">Approve</button>
                                            </form>
                                            <form method="post" class="my-4 declined"
                                                action="" >
                                                @csrf
                                                <input type="hidden" name="status" value="declined">
                                                <button type="submit" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#declined">Decline</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Evidence</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('.pop').on('click', function() {
                    var id = $(this).next('input').val();
                    $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                    $(`#imagemodal-${id}`).modal('show');
                });
            });

        });
        $(document).ready(function() {
            $(".activate").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(e.target);
                var investment_id = $(this).closest("tr").find('.investement_id').val();
                // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to approve this investments",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`/admin/investments/${investment_id}`, {
                                method: 'POST',
                                body: formData
                            }).then(() => {
                                console.log('success');
                                swal(
                                    "Investment approved", {
                                        icon: "success",
                                    }).then(() =>  location.reload());

                            });

                        } else {
                            swal("Approval cancelled");
                        }
                    });
            });


            $(".declined").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(e.target);
                var investment_id = $(this).closest("tr").find('.investement_id').val();
                // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to decline this investment",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            fetch(`/admin/investments/${investment_id}`, {
                                method: 'POST',
                                body: formData
                            }).then(() => {
                                console.log('success');
                                swal(
                                    "Investment Declined", {
                                        icon: "success",
                                    }).then(() =>  location.reload());

                            });

                        } else {
                            swal("Approval cancelled");
                        }
                    });
            });
        });

    </script>
@endpush
