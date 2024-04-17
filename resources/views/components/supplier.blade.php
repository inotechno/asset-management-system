@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Daftar Supplier</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-supplier">Tambah
                                Supplier</button>
                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped align-middle dt-responsive nowrap w-100" id="supplier-table">
                        <thead>
                            <th scope="col" style="width: 10px">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Telp</th>
                            <th scope="col">URL</th>
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

    <div class="modal fade" id="modal-add-supplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-add-supplier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-add-supplier">Tambah Supplier
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('supplier.store') }}" id="form-add-supplier">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Nama Supplier</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Telp</label>
                                    <input type="number" class="form-control" name="telp">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">URL</label>
                                    <input type="url" class="form-control" name="url">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-add-supplier" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-supplier" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-update-supplier" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-update-supplier">Ubah Supplier
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-update-supplier">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Nama Supplier</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Telp</label>
                                    <input type="number" class="form-control" name="telp">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">URL</label>
                                    <input type="url" class="form-control" name="url">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-update-supplier" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <form action="" id="form-delete-supplier">
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
    Supplier
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
            var table = $("#supplier-table").DataTable({
                lengthChange: !1,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('supplier.datatable') }}",
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
                        data: 'telp',
                        name: 'telp'
                    },
                    {
                        data: 'url',
                        name: 'url'
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

            $('#form-add-supplier').submit(function() {
                var data = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == false) {
                            if (response.hasOwnProperty('data')) {
                                $.each(response.data.error, function(i, v) {
                                    // console.log(v);
                                    $('#form-add-supplier [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('add-supplier');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-update-supplier').submit(function() {
                var data = $(this).serialize();

                $.ajax({
                    type: "PUT",
                    url: $(this).attr('action'),
                    data: data,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success == false) {
                            if (response.hasOwnProperty('data')) {
                                $.each(response.data.error, function(i, v) {
                                    // console.log(v);
                                    $('#form-update-supplier [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('update-supplier');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-delete-supplier').submit(function() {
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
                                    $('#form-delete-supplier [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('delete-supplier');
                        // console.log(response);
                    }
                });

                return false;
            });




            $('#supplier-table').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $('#modal-update-supplier').modal('show');

                var action = "{{ url('supplier/edit') }}/" + id;

                $('#form-update-supplier').attr('action', action);

                $.ajax({
                    type: "get",
                    url: action,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            $.each(response.data, function(i, v) {
                                $('#form-update-supplier [name="' + i + '"]').val(v);
                            });
                        } else {
                            notification('error', response.message);
                        }
                        // console.log(response);
                    }
                });

                return false;
            })

            $('#supplier-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('#form-delete-supplier').attr('action', "{{ url('supplier/delete') }}/" + id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "Apakah anda yakin ingin menghapus Supplier ini ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!",
                }).then(function(t) {
                    if (t.isConfirmed != false) {
                        $('#form-delete-supplier').submit();
                    }
                });
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
