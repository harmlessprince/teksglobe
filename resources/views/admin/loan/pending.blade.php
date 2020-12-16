@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Pending Loans</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Total Payable</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td>
                                            <span
                                                class="badge-dot {{ $loan->status === 'approved' ? 'badge-primary' : 'badge-danger' }}"></span>
                                        </td>
                                        <td>{{ $loan->user->name }}</td>
                                        <td>{{ $loan->created_at->format('d M, Y H:i A') }}</td>
                                        <td>{{ number_format($loan->amount, 2) }}</td>
                                        <td>{{ number_format($loan->charge, 2) }}</td>
                                        <td>{{ number_format($loan->amount + $loan->charge, 2) }}</td>
                                        <td>{{ $loan->status }}</td>
                                        {{-- <td>
                                            {{ optional($loan->verified_at)->format('d M, Y H:i A') }}
                                        </td>
                                        --}}
                                        <td>
                                            <form method="post" class="my-4"
                                                action="{{ route('admin.loans.update', $loan->id) }}">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>


                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#declineModal-{{ $loan->id }}">
                                                Decline
                                            </button>
                                            {{--
                                            </form> --}}
                                            <!-- Modal -->
                                            <form method="post" class="my-4"
                                                action="{{ route('admin.loans.destroy', $loan->id) }}">
                                                @csrf
                                                <div class="modal fade" id="declineModal-{{ $loan->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-warning" id="exampleModalLabel">
                                                                    Are you sure you want to decline this loan
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="status" value="declined">
                                                                <div class="form-group">
                                                                    <label for="narration">Kindly state reason for
                                                                        declination of this loan</label>
                                                                    <textarea name="narration" id="" cols="30" rows="4"
                                                                        class="form-control" id="narration" required ></textarea>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-warning">Yes Decline
                                                                    Loan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('scripts')
    {{-- <script>
        $('#declineModal').on('show', function(e) {
            var link = e.relatedTarget();
            var modal = $(this);
            var id = link.data("id");


            modal.find("#id").val(id);
            // modal.find("#username").val(username);
        });

    </script> --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/data-table.js') }}"></script>
@endpush
