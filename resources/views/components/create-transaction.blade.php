@extends('layouts.App')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">Tambah Transaksi</h5>
                        <div class="flex-shrink-0">
                            <button type="submit" class="btn btn-primary" form="form-add-transaction">Kirim</button>
                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('transaction.store') }}" id="form-add-transaction"
                        class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Karyawan</label>
                                    <select name="employee_id"
                                        class="form-control select2-employee @error('employee_id') is-invalid @enderror">
                                        <option value="">Pilih Karyawan</option>
                                    </select>
                                </div>

                                @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Divisi</label>
                                    <select name="division_id"
                                        class="form-control select2-division @error('division_id') is-invalid @enderror"
                                        id="">
                                        <option value="">Pilih Divisi</option>
                                    </select>
                                </div>

                                @error('division_id')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <select name="status"
                                        class="form-control select2-status @error('status') is-invalid @enderror"
                                        id="">
                                        <option value="">Pilih Status</option>
                                        <option value="0">IN</option>
                                        <option value="1">OUT</option>
                                    </select>
                                </div>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Note</label>
                                    <input type="text" class="form-control @error('note') is-invalid @enderror"
                                        name="note">
                                </div>

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md">
                                <table class="table align-middle" id="table-asset">
                                    <thead>
                                        <th>UID</th>
                                        <th>Kategori</th>
                                        <th>Spesifikasi</th>
                                        <th>Tahun Produksu</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Harga</th>
                                        <th>Kondisi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="uid[0]" class="form-control select2-asset" id="">
                                                    <option value="">Cari Asset</option>
                                                </select>
                                            </td>
                                            <td class="category"></td>
                                            <td class="specification"></td>
                                            <td class="production_year"></td>
                                            <td class="purchase_date"></td>
                                            <td class="purchase_price"></td>
                                            <td class="condition"></td>
                                            <td class="status"></td>
                                            <td class="action"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->

    </div>
@endsection

@section('css')
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Asset
@endsection

@section('plugin')
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

    <script>
        $(function() {
            var i = 0;
            select2();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $('#form-add-transaction').submit(function() {
                $('#form-add-transaction small.text-danger').remove();

                var data = $(this).serialize();

                var arr = [];
                var duplicates = false;

                $('.select2-asset').each(function() {
                    var value = $(this).val();
                    if (arr.indexOf(value) == -1) {
                        arr.push(value);
                    } else {
                        duplicates = true;
                    }
                });

                // console.log(arr);

                if (duplicates) {
                    notification('error',
                        'Ada asset yang sama, silahkan diubah terlebih dahulu!');
                    return false;
                }

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
                                    $('#form-add-transaction [name="' + i + '"]').after(
                                        '<small class="text-danger">' + v +
                                        '</small>');
                                });
                            } else {
                                notification('error', response.message);
                            }

                            return false;
                        }

                        notification('success', response.message);
                        window.location.href = "{{ route('transaction') }}";
                    }
                });

                return false;
            });

            function select2() {
                $('.select2-asset').select2({
                    width: '100%',
                    ajax: {
                        url: "{{ route('select.asset') }}",
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
            }

            $('#table-asset').on('change', '.select2-asset', function() {
                var id = $(this).val();
                var row = $(this);

                $.ajax({
                    type: "get",
                    url: "{{ URL('select/asset') }}/" + id,
                    dataType: "JSON",
                    success: function(response) {
                        row.attr('name', 'uid[' + i + ']');
                        row.parent().parent().find('.category').html(response.category.name);
                        row.parent().parent().find('.specification').html(response
                            .specification);
                        row.parent().parent().find('.production_year').html(response
                            .production_year);
                        row.parent().parent().find('.purchase_date').html(response
                            .purchase_date);
                        row.parent().parent().find('.purchase_price').html(response
                            .purchase_price);
                        row.parent().parent().find('.condition').html(response.condition);

                        var status = '';
                        if (response.status == 0) {
                            status =
                                '<span class="badge bg-success">Standby</span>';
                        } else {
                            status =
                                '<span class="badge bg-danger">Not Standby</span>';
                        }

                        row.parent().parent().find('.status').html(status);
                        row.parent().parent().find('.action').html(
                            '<a href="#" class="text-danger btn-delete"><i class="bx bx-x-circle bx-sm"></i></a>'
                        );

                        if (row.attr('add') != 'yes') {
                            $('#table-asset tbody').append('<tr>' +
                                '                              <td>' +
                                '                                  <select name="" class="form-control select2-asset" id="">' +
                                '                                      <option value="">Cari Asset</option>' +
                                '                                  </select>' +
                                '                              </td>' +
                                '                              <td class="category"></td>' +
                                '                              <td class="specification"></td>' +
                                '                              <td class="production_year"></td>' +
                                '                              <td class="purchase_date"></td>' +
                                '                              <td class="purchase_price"></td>' +
                                '                              <td class="condition"></td>' +
                                '                              <td class="status"></td>' +
                                '                              <td class="action"></td>' +
                                '                          </tr>');
                        }

                        row.attr('add', 'yes');

                        // $('.select2-asset').select2();
                        select2();
                        i++;
                    }
                });

                return false;
            });

            $('#table-asset').on('click', '.btn-delete', function() {
                $(this).closest('tr').remove();
            })

            $('.select2-employee').select2({
                width: '100%',
                ajax: {
                    url: "{{ route('select.employee') }}",
                    type: "get",
                    dataType: 'json',
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

            $('.select2-division').select2({
                width: '100%',
                ajax: {
                    url: "{{ route('select.division') }}",
                    type: "get",
                    dataType: 'json',
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
