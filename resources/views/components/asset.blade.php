@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Daftar Asset</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-asset">Tambah
                                Asset</button>
                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped align-middle dt-responsive nowrap w-100" id="asset-table">
                        <thead>
                            <th scope="col" style="width: 10px">No</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Images</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Spesifikasi</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Status</th>
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

    <div class="modal fade" id="modal-add-asset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-add-asset" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-add-asset">Tambah Asset
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('asset.store') }}" id="form-add-asset"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Kategori</label>
                                    <select name="category_id" class="form-control select2-add-category" id="">
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Supplier</label>
                                    <select name="supplier_id" class="form-control select2-add-supplier" id="">
                                        <option value="">Pilih Supplier</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Spesifikasi</label>
                                    <textarea name="specification" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="row my-5" id="upload-file">
                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto1" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto2" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto3" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto4" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto5" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Tahun Produksi</label>
                                        <input type="number" class="form-control" name="production_year">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Harga Beli</label>
                                        <input type="number" class="form-control" name="purchase_price">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Tanggal Beli</label>
                                        <input type="date" class="form-control" name="purchase_date">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Kondisi</label>
                                        <select name="condition" class="form-control select2-add" id="">
                                            <option value="baru">Baru</option>
                                            <option value="bekas">Bekas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-add-asset" id="btn-add-submit"
                        class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-update-asset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-update-asset" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-update-asset">Ubah Asset
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-update-asset" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Kategori</label>
                                    <select name="category_id" class="form-control select2-update-category"
                                        id="">
                                        <option value="">Pilih Kategori</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Supplier</label>
                                    <select name="supplier_id" class="form-control select2-update-supplier"
                                        id="">
                                        <option value="">Pilih Supplier</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Spesifikasi</label>
                                    <textarea name="specification" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="row my-5" id="upload-file-update">
                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto1" />
                                            <input type="hidden" name="foto1_old" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto2" />
                                            <input type="hidden" name="foto2_old" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto3" />
                                            <input type="hidden" name="foto3_old" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto4" />
                                            <input type="hidden" name="foto4_old" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <div class="wrapper">
                                        <div class="file-upload">
                                            <input type="file" class="upload-image" name="foto5" />
                                            <input type="hidden" name="foto5_old" />
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Tahun Produksi</label>
                                        <input type="number" class="form-control" name="production_year">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Harga Beli</label>
                                        <input type="number" class="form-control" name="purchase_price">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Tanggal Beli</label>
                                        <input type="date" class="form-control" name="purchase_date">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="">Kondisi</label>
                                        <select name="condition" class="form-control select2-add" id="">
                                            <option value="baru">Baru</option>
                                            <option value="bekas">Bekas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-update-asset" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-view-asset" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="title-view-asset" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-view-asset">View Asset
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped align-middle">
                        <tr>
                            <td>Barcode</td>
                            <td>:</td>
                            <td id="barcode"></td>
                        </tr>

                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td id="category"></td>
                        </tr>

                        <tr>
                            <td>Supplier</td>
                            <td>:</td>
                            <td id="supplier"></td>
                        </tr>

                        <tr>
                            <td>Spesifikasi</td>
                            <td>:</td>
                            <td id="specification"></td>
                        </tr>

                        <tr>
                            <td>Tanggal Pembelian</td>
                            <td>:</td>
                            <td id="purchase_date"></td>
                        </tr>

                        <tr>
                            <td>Harga Beli</td>
                            <td>:</td>
                            <td id="purchase_price"></td>
                        </tr>

                        <tr>
                            <td>Tahun Produksi</td>
                            <td>:</td>
                            <td id="production_year"></td>
                        </tr>

                        <tr>
                            <td>Kondisi</td>
                            <td>:</td>
                            <td id="condition"></td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td id="status_asset"></td>
                        </tr>
                    </table>
                    <div class="row mt-3" id="images-view"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-image-asset" tabindex="-1" role="dialog" aria-labelledby="title-image-asset"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">

                </div>
            </div>
        </div>
    </div>

    <form action="" id="form-delete-asset">
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
    <style>
        .wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wrapper .file-upload {
            height: 50px;
            width: 50px;
            border-radius: 25px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid #fff;
            overflow: hidden;
            background-image: linear-gradient(to bottom, #2590eb 50%, #fff 50%);
            background-size: 100% 200%;
            transition: all 1s;
            color: #fff;
            font-size: 25px;
        }

        .wrapper .file-upload input[type='file'] {
            height: 50px;
            width: 50px;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .wrapper .file-upload:hover {
            background-position: 0 -100%;
            color: #2590eb;
        }
    </style>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#upload-file').on('change', '.upload-image', function() {
                var files = [],
                    fileArr, filename;

                filename = $(this).val().split('\\').pop();
                $(this).parent().parent().parent().append('<small>' + filename +
                    '</small>');
            });

            $('#upload-file-update').on('change', '.upload-image', function() {
                $(this).parent().parent().parent().find('small').remove();
                var files = [],
                    fileArr, filename;

                filename = $(this).val().split('\\').pop();
                $(this).parent().parent().parent().append('<small>' + filename +
                    '</small>');
            });

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var table = $("#asset-table").DataTable({
                lengthChange: !1,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('asset.datatable') }}",
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
                        data: '_barcode',
                        name: 'uid',
                        className: 'text-center'
                    },
                    {
                        data: '_images',
                        name: 'uid',
                        className: 'text-center'
                    },
                    {
                        data: 'category.name',
                        name: 'category_id'
                    },
                    {
                        data: 'specification',
                        name: 'specification'
                    },
                    {
                        data: 'condition',
                        name: 'condition'
                    },
                    {
                        data: '_status',
                        name: 'status'
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

            $('#form-add-asset').submit(function() {
                $('#form-add-asset small.text-danger').remove();
                var data = new FormData($(this)[0]);

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: data,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#btn-add-submit').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#btn-add-submit').prop('disabled', false);

                        if (response.success == false) {
                            if (response.hasOwnProperty('data')) {
                                $.each(response.data.error, function(i, v) {
                                    // console.log(v);
                                    $('#form-add-asset [name="' + i + '"]')
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
                        drawTable('add-asset');

                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-update-asset').submit(function() {
                $('#form-add-asset small.text-danger').remove();
                var data = new FormData($(this)[0]);

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: data,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#btn-update-asset').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#btn-update-asset').prop('disabled', false);
                        if (response.success == false) {
                            if (response.hasOwnProperty('data')) {
                                $.each(response.data.error, function(i, v) {
                                    // console.log(v);
                                    $('#form-update-asset [name="' + i + '"]')
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
                        drawTable('update-asset');
                        // console.log(response);
                    }
                });

                return false;
            });

            $('#form-delete-asset').submit(function() {
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
                                    $('#form-delete-asset [name="' + i + '"]')
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
                        drawTable('delete-asset');
                        // console.log(response);
                    }
                });

                return false;
            });



            $('#asset-table').on('click', '.btn-view', function() {
                var id = $(this).data('id');
                $('#modal-view-asset').modal('show');

                var action = "{{ url('asset/edit') }}/" + id;

                $.ajax({
                    type: "get",
                    url: action,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            $('#modal-view-asset #barcode').html(response.data.barcode);
                            $('#modal-view-asset #category').html(response.data.category.name);
                            $('#modal-view-asset #supplier').html(response.data.supplier.name);
                            $('#modal-view-asset #specification').html(response.data
                                .specification);
                            $('#modal-view-asset #production_year').html(response.data
                                .production_year);
                            $('#modal-view-asset #purchase_date').html(response.data
                                .purchase_date);
                            $('#modal-view-asset #purchase_price').html(response.data
                                .purchase_price);
                            $('#modal-view-asset #condition').html(response.data
                                .condition);

                            if (status == 0) {
                                $('#modal-view-asset #status_asset').html(
                                    '<span class="badge bg-success">Standby</span>');
                            } else {
                                $('#modal-view-asset #status_asset').html(
                                    '<span class="badge bg-danger">Not Standby</span>');
                            }

                            var images = '';
                            // $.each(response.data, function(i, v) {
                            //     $('#form-update-asset [name="' + i + '"]').val(v);
                            // });
                            var public_path = "{{ asset('images/assets') }}";

                            $.each(response.data.image, function(i, v) {
                                images += '<div class="col-md">' +
                                    '           <img src="' + public_path + '/' + v
                                    .name + '" class="img-fluid">' +
                                    '       </div>';
                            });

                            $('#modal-view-asset #images-view').html(images);
                        } else {
                            notification('error', response.message);
                        }
                        console.log(response);
                    }
                });

                return false;
            })

            $('#asset-table').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                $('#modal-update-asset').modal('show');

                var action = "{{ url('asset/edit') }}/" + id;

                $('#form-update-asset').attr('action', action);

                $.ajax({
                    type: "get",
                    url: action,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            // $('#form-update-asset [name="category_id"]').val(response.data
                            //     .category.name).trigger('change.select2');
                            // $('#form-update-asset [name="supplier_id"]').val(response.data
                            //     .category.name).trigger('change.select2');

                            // $('#form-update-asset [name="specification"]').val(response.data
                            //     .specification).trigger('change');
                            // $('#form-update-asset [name="production_year"]').val(response.data
                            //     .production_year).trigger('change');
                            // $('#form-update-asset [name="purchase_price"]').val(response.data
                            //     .purchase_price).trigger('change');
                            // $('#form-update-asset [name="purchase_date"]').val(response.data
                            //     .purchase_date).trigger('change');
                            // $('#form-update-asset [name="condition"]').val(response.data
                            //     .condition).trigger('change');

                            $.each(response.data, function(i, v) {
                                $('#form-update-asset [name="' + i + '"]').val(v);
                            });

                            $.each(response.data.image, function(i, v) {
                                $('#form-update-asset [name="foto' + (i + 1) + '_old"]')
                                    .val(v.name).trigger('change');
                                $('#form-update-asset [name="foto' + (i + 1) + '_old"]')
                                    .parent().parent().parent().append('<small>' +
                                        v.name +
                                        '</small>');
                            });

                        } else {
                            notification('error', response.message);
                        }
                        console.log(response);
                    }
                });

                return false;
            })

            $('#asset-table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                $('#form-delete-asset').attr('action', "{{ url('asset/delete') }}/" + id);

                Swal.fire({
                    title: "Are you sure?",
                    text: "Apakah anda yakin ingin menghapus asset ini ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#34c38f",
                    cancelButtonColor: "#f46a6a",
                    confirmButtonText: "Yes, delete it!",
                }).then(function(t) {
                    if (t.isConfirmed != false) {
                        $('#form-delete-asset').submit();
                    }
                });
            });

            $('#asset-table').on('click', '.image-asset', function() {
                var src = $(this).find('img').attr('src');
                $('#modal-image-asset .modal-body img').remove();

                $('#modal-image-asset .modal-body').append('<img class="img-fluid" src="' + src +
                    '" >');
                $('#modal-image-asset').modal('show');

            })

            function drawTable(param) {
                table.draw();

                if (param != null) {
                    $('#form-' + param)[0].reset();
                    $('#form-' + param).trigger('reset');
                    $('#modal-' + param).modal('hide');
                }
            }

            $('.select2-add-category').select2({
                width: '100%',
                tags: true,
                dropdownParent: "#modal-add-asset",
                ajax: {
                    url: "{{ route('select.category') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $('.select2-add-supplier').select2({
                width: '100%',
                tags: true,
                dropdownParent: "#modal-add-asset",
                ajax: {
                    url: "{{ route('select.supplier') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $('.select2-update-category').select2({
                width: '100%',
                tags: true,
                dropdownParent: "#modal-update-asset",
                ajax: {
                    url: "{{ route('select.category') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $('.select2-update-supplier').select2({
                width: '100%',
                tags: true,
                dropdownParent: "#modal-update-asset",
                ajax: {
                    url: "{{ route('select.supplier') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term // search term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

        });
    </script>
@endsection
