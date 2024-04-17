@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Daftar Karyawan</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-employee">Tambah
                                Karyawan</button>
                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped align-middle dt-responsive nowrap w-100" id="employee-table">
                        <thead>
                            <th scope="col" style="width: 10px">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">HP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
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

    <div class="modal fade" id="modal-add-employee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-add-employee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-add-employee">Tambah Karyawan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employee.store') }}" id="form-add-employee">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Nama Karyawan</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">HP</label>
                                    <input type="number" class="form-control" name="hp">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-add-employee" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-employee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-update-employee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-update-employee">Ubah Karyawan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-update-employee">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Nama Karyawan</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">HP</label>
                                    <input type="number" class="form-control" name="hp">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Alamat</label>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-update-employee" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <form action="" id="form-delete-employee">
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
    Karyawan
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
            var table = $("#employee-table").DataTable({
                lengthChange: !1,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('employee.datatable') }}",
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
                        data: 'hp',
                        name: 'hp'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: '_address',
                        name: 'address',
                        render: function(data, type, full, meta) {
                            return "<div class='text-wrap width-200'>" + data + "</div>";
                        },
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

            $('#form-add-employee').submit(function() {
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
                                    $('#form-add-employee [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('add-employee');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-update-employee').submit(function() {
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
                                    $('#form-update-employee [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('update-employee');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-delete-employee').submit(function() {
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
                                    $('#form-delete-employee [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        drawTable('delete-employee');
                        // console.log(response);
                    }
                });

                return false;
            });




            $('#employee-table').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $('#modal-update-employee').modal('show');

                var action = "{{ url('employee/edit') }}/" + id;

                $('#form-update-employee').attr('action', action);

                $.ajax({
                    type: "get",
                    url: action,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            $.each(response.data, function(i, v) {
                                $('#form-update-employee [name="' + i + '"]').val(v);
                            });
                        } else {
                            notification('error', response.message);
                        }
                        // console.log(response);
                    }
                });

                return false;
            })

            $('#employee-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('#form-delete-employee').attr('action', "{{ url('employee/delete') }}/" + id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "Apakah anda yakin ingin menghapus karyawan ini ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!",
                }).then(function(t) {
                    if (t.isConfirmed != false) {
                        $('#form-delete-employee').submit();
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
