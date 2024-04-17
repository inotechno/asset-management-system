@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Monitoring Company</h5>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped align-middle dt-responsive nowrap w-100" id="monitoring-company-table">
                        <thead>
                            <th scope="col" style="width: 10px">No</th>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Singkatan</th>
                            <th scope="col">Jumlah Divisi</th>
                            <th scope="col">Jumlah Transaksi</th>
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

    <div class="modal fade" id="modal-hitory-transaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-hitory-transaction" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-hitory-transaction">History Transaksi Per Asset
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td style="width: 20%">Nama Perusahaan</td>
                            <td style="width: 3%">:</td>
                            <td id="name-detail"></td>
                        </tr>

                        <tr>
                            <td style="width: 20%">Singkatan</td>
                            <td style="width: 3%">:</td>
                            <td id="abbreviation-detail"></td>
                        </tr>

                        {{--
                        <tr>
                            <td style="width: 20%">Status</td>
                            <td style="width: 3%">:</td>
                            <td id="status-detail"></td>
                        </tr> --}}
                    </table>

                    <h5 class="mt-5">Detail Transaksi</h5>
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Divisi</th>
                            <th>No Order</th>
                            <th>UID</th>
                            <th>Kategori</th>
                            <th>Spesifikasi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </thead>
                        <tbody id="table-body-transaksi"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
    Asset
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
            var table = $("#monitoring-company-table").DataTable({
                lengthChange: !1,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('monitor.company.datatable') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'abbreviation',
                        name: 'abbreviation'
                    },
                    {
                        data: '_jumlah_division',
                        name: '_jumlah_division'
                    },
                    {
                        data: '_jumlah_transaksi',
                        name: '_jumlah_transaksi'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#monitoring-company-table').on('click', '.btn-history', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var abbreviation = $(this).data('abbreviation');

                $('#modal-hitory-transaction').modal('show');

                var action = "{{ url('monitoring/company/detail') }}/" + id;

                $.ajax({
                    type: "get",
                    url: action,
                    dataType: "JSON",
                    success: function(response) {
                        $('#name-detail').html(name);
                        $('#abbreviation-detail').html(abbreviation);

                        var html = "";

                        if (response.data.length > 0) {
                            $.each(response.data, function(i, v) {
                                var status = '';
                                if (v.transaction.status == 0) {
                                    status =
                                        '<span class="badge bg-success">IN</span>';
                                } else {
                                    status =
                                        '<span class="badge bg-danger">OUT</span>';
                                }

                                if (v.transaction.note == null) {
                                    v.transaction.note = "";
                                }

                                var created_at = moment(v.transaction.created_at).lang(
                                        'id')
                                    .format(
                                        'Do MMMM YYYY H:mm:ss')

                                html += '<tr>' +
                                    '       <td>' + (i + 1) + '</td>' +
                                    '       <td>' + v.transaction.division.name +
                                    '       <td>' + v.transaction.order_number +
                                    '</td>' +
                                    '       <td>' + v.asset.uid + '</td>' +
                                    '       <td>' + v.asset.category.name + '</td>' +
                                    '       <td>' + v.asset.specification + '</td>' +
                                    '       <td>' + status + '</td>' +
                                    '       <td>' + created_at + '</td>' +
                                    '    </tr>';
                            });
                        } else {
                            html =
                                '<tr><td colspan="8" class="text-center">Tidak ada data</td></tr>';
                        }

                        $('#table-body-transaksi').html(html);
                        console.log(response)
                    }
                });

                return false;
            })

            function drawTable(param) {
                table.draw();

                if (param != null) {
                    $('#form-' + param)[0].reset();
                    $('#form-' + param).trigger('reset');
                    $('#modal-' + param).modal('hide');
                }
            }
        });
    </script>
@endsection
