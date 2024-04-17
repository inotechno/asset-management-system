@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Daftar Transaksi</h5>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped align-middle dt-responsive nowrap w-100" id="transaction-table">
                        <thead>
                            <th scope="col" style="width: 10px">No</th>
                            <th scope="col">Karyawan</th>
                            <th scope="col">Divisi</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Asset</th>

                            <th scope="col">Created At</th>
                            <th scope="col" style="width:30px">Action</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!--end row-->
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

    </div>

    <div class="modal fade" id="modal-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="title-view" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-view">Transaksi Detail
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 30%">No Order</td>
                            <td style="width: 5%">:</td>
                            <td id="order_number"></td>
                        </tr>

                        <tr>
                            <td style="width: 30%">Nama Karyawan</td>
                            <td style="width: 5%">:</td>
                            <td id="name"></td>
                        </tr>

                        <tr>
                            <td style="width: 30%">Divisi</td>
                            <td style="width: 5%">:</td>
                            <td id="division"></td>
                        </tr>

                        <tr>
                            <td style="width: 30%">Status</td>
                            <td style="width: 5%">:</td>
                            <td id="status-detail"></td>
                        </tr>

                        <tr>
                            <td style="width: 30%">Catatan</td>
                            <td style="width: 5%">:</td>
                            <td id="note"></td>
                        </tr>
                    </table>

                    <table class="table" id="table-detail-transaction">
                        <thead>
                            <th>UID</th>
                            <th>Kategori</th>
                            <th>Spesifikasi</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form action="" id="form-delete-transaction">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Transaksi
@endsection

@section('plugin')
    <!-- Required datatable js -->
    <script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

    <script>
        $(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var table = $("#transaction-table").DataTable({
                lengthChange: !1,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transaction.datatable') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = CSRF_TOKEN;
                    }
                },
                columnDefs: [{
                    className: "align-middle",
                    targets: "_all"
                }, ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'employee.name',
                        name: 'employee'
                    },
                    {
                        data: 'division.name',
                        name: 'division'
                    },
                    {
                        data: 'note',
                        name: 'note'
                    },
                    {
                        data: '_status',
                        name: 'status'
                    },
                    {
                        data: '_asset',
                        name: 'asset',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(value) {
                            if (value === null) return "";
                            return moment(value).lang('id').format(
                                'Do MMMM YYYY H:mm:ss');
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#form-delete-transaction').submit(function() {
                var data = $(this).serialize();

                $.ajax({
                    type: "DELETE",
                    url: $(this).attr('action'),
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == false) {
                            if (response.hasOwnProperty('data')) {
                                $.each(response.data.error, function(i, v) {
                                    // console.log(v);
                                    $('#form-delete-transaction [name="' + i + '"]')
                                        .after(
                                            '<small class="text-danger">' + v +
                                            '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('delete-transaction');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#transaction-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('#form-delete-transaction').attr('action', "{{ url('transaction/delete') }}/" + id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "Apakah anda yakin ingin menghapus transaksi ini ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!",
                }).then(function(t) {
                    if (t.isConfirmed != false) {
                        $('#form-delete-transaction').submit();
                    }
                });
            });

            $('#transaction-table').on('click', '.btn-view', function() {
                var id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('transaction/detail') }}/" + id,
                    dataType: "JSON",
                    success: function(response) {
                        $('#order_number').html(response.data.order_number);
                        $('#name').html(response.data.employee.name);
                        $('#division').html(response.data.division.name);

                        if (response.data.status == 0) {
                            $('#status-detail').html('<span class="badge bg-info">IN</span>');
                            // console.log('IN');
                        } else {
                            $('#status-detail').html(
                                '<span class="badge bg-danger">OUT</span>');
                            // console.log('OUT');
                        }

                        $('#note').html(response.data.note);
                        $('#modal-view').modal('show');

                        var detail = "";

                        $.each(response.data.detail, function(i, v) {
                            detail += '<tr>' +
                                '           <td>' + v.asset.uid + '</td>' +
                                '           <td>' + v.asset.category.name + '</td>' +
                                '           <td>' + v.asset.specification + '</td>' +
                                '      </tr>';
                        });

                        $('#table-detail-transaction tbody').html(detail);
                    }
                });

                return false;
            });

            function drawTable(param) {
                table.draw();

                if (param != null) {
                    $('#form-' + param)[0].reset();
                    $('#modal-' + param).modal('hide');
                }
            }

        });
    </script>
@endsection
