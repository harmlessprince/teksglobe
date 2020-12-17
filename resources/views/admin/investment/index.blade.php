@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
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
                <h5 class="card-header">All Investments</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Evidence</th>
                                    <th>Verified at</th>
                                    <th>Verified by</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($investments as $investment)
                                    <tr>
                                        <td>{{ $investment->user->name }}</td>
                                        <td>{{ $investment->package->name }}</td>
                                        <td>{{ number_format($investment->amount, 2) }}</td>
                                        <td>{{ number_format($investment->balance, 2) }}</td>
                                        <td>
                                            <a href="#" class="card-link text-success">Approved</a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-center pop">
                                                <img src="{{ url($investment->evidence) }}" alt="evidence"
                                                    class="user-avatar-md rounded-circle pop">
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
                                        <td>{{ $investment->verified_at ? $investment->verified_at->format('d M, Y H:i A') : '' }}
                                        </td>
                                        <td>{{ $investment->verifiedBy->name ?? '' }}</td>
                                        <td> {{ $investment->created_at->format('d M, Y H:i A') }}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Investor name</th>
                                    <th>Package name</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Evidence</th>
                                    <th>Verified at</th>
                                    <th>Verified by</th>
                                    <th>Created at</th>
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

    </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
