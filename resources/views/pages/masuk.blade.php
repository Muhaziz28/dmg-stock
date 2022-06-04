@extends('pages.page.layout')

@section('title', 'Data Barang Masuk')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">Data Barang Masuk</h4>

        <div class="mb-4">

            <div class="alert alert-info d-flex" role="alert">
                <span class="badge badge-center rounded-pill border-label-info bg-info p-3 me-2"><i class="bx bxs-alarm-exclamation fs-6"></i></span>
                <div class="d-flex flex-column ps-1">
                    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Perhatian!!</h6>
                    <span>Data barang masuk diurutkan berdasarkan barang terakhir masuk!</span>
                </div>
            </div>

        </div>
        <div class="row">
            @foreach ($barang as $b)
            <div class="col-sm-6 col-md-6 col-lg-3 mb-4" id="stock">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-info">
                                <p class="card-text">{{ $b->nama_barang }}</p>
                                <div class="d-flex align-items-end mb-2">
                                    <h4 class="card-title me-2 mb-0">{{ $b->stok }}</h4>

                                </div>
                                <small>Stok terkini</small>
                            </div>
                            <div class="card-icon">
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="bx bx-trending-up bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Filter</h5>
                    </div>
                    <div class="card-body">
                        <form id="filter">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="filter-barang" class="form-label">Barang</label>
                                    <select name="filter-barang" id="filter-barang" class="form-select select2 filter">
                                        <option value="">--Filter berdasarkan barang--</option>
                                        @foreach ($barang as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="filter-tanggal" class="form-label">Basic</label>
                                    <input type="date" id="filter-tanggal" name="filter-tanggal" class="form-control filter" />
                                </div>

                                <!-- <div class="mt-2"> 
                                    <button class="btn btn-danger" type="submit" id="reset-filter">Reset Filter</button>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-masuk table border-top" id="masuk-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Stok Masuk</th>
                            <th>Barang</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->

        <!-- Modal -->
        <div class="modal fade" id="masukModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Tambah Bahan Baru</h3>
                            <p>Form tambah bahan.</p>
                        </div>
                        <form class="needs-validation" action="{{ route('dmg.addMasuk') }}" method="POST" id="add-bahan-form">
                            @csrf

                            <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
                            <div class="col-12 mb-3">
                                <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="tanggal" id="tanggal" required autofocus />
                                <span class="text-danger error-text tanggal_error"></span>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="id_barang">Barang</label>
                                <select class="form-control select2" name="id_barang" id="id_barang" required name="id_barang">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($barang as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_barang }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="stok_masuk" class="form-label">Stok Masuk</label>
                                <input type="number" class="form-control" placeholder="Stok Masuk" id="stok_masuk" name="stok_masuk" required />
                            </div>
                            <div class="col-12 text-center demo-vertical-spacing">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Save</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <!-- <div class="modal fade" id="masukModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Tambah Barang Masuk</h3>
                            <p>Form tambah barang masuk.</p>
                        </div>
                        <form class="needs-validation" action="{{ route('dmg.addBarang') }}" method="POST" id="add-barang-form">
                            @csrf
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" style="margin-bottom: 80px;" id="dynamic_form">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center;">Tanggal Masuk <span class="text-danger">*</span></th>
                                            <th scope="col" colspan="2" style="vertical-align: middle; text-align: center;">Data Barang<span class="text-danger">*</span></th>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Nama Barang</th>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Variasi <span class="text-danger">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td id="col0">
                                                <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="tanggal[]" id="tanggal" required autofocus />
                                                <span class="text-danger error-text tanggal_error"></span>
                                            </td>
                                            <td id="col1">
                                                <select class="form-control " name="id_barang[]" id="id_barang" required name="id_barang">
                                                    <option value="">--Pilih Barang--</option>
                                                    @foreach ($barang as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_barang }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td id="col2">
                                                <div class="input-group">
                                                    <input class="form-control" required type="number" name="stok_masuk[]" placeholder="Stok Masuk" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                            <tr>
                                <td style="width: 100% ">
                                    <div class="form-group d-flex justify-content-between">
                                        <button class="btn btn-outline-success btn-" type="button" onclick="addRows()"> + Tambah Form</button>
                                        <button type="button" class="btn btn-outline-danger " onclick="deleteRows()"> - Hapus Form</button>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal-footer mt-3">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
            </div>
            <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blx`ank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
            </div>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('script')
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('#add-bahan-form').submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        // alert(data.msg);
                        $('#masukModal').modal('hide');

                        // reload stock card

                        window.location.reload();
                        $('#add-bahan-form button[type="submit"]').html('Save');
                        toastr.success(data.msg, 'Success!');
                    }
                }
            })
        });


        $('#masuk-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('dmg.getMasuk') }}",
                type: "GET",
                data: function(d) {
                    d.barang = barang;
                    d.tanggal = tanggal;
                    return d
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'tanggal',
                    name: 'tanggal',
                    render: function(data, type, row) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    data: 'stok_masuk',
                    name: 'stok_masuk',
                    render: function(data, type, row) {
                        return '+ ' + data + "pcs";
                    }
                },
                {
                    data: 'barang.nama_barang',
                    name: 'barang.nama_barang',
                    render: function(data, type, row) {
                        return row.barang.nama_barang + ', KODE BRG: ' + '<span class="text-primary">' + row.barang.kode_barang + '</span>' + ', STOK TERKINI: ' + '<span class="text-primary">' + row.stok_awal + '</span>';
                    }
                },
            ],
            dom: '<"row mx-1"' +
                '<"col-sm-12 col-md-3" l>' +
                '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
                '>t' +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: '_MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..',
                processing: '<i class="fas fa-spinner fa-spin"></i>',
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Tambah Barang Masuk',
                className: 'add-new btn btn-primary mb-3 mb-md-0',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#masukModal',
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }],
        });

        // var bsRangePickerBasic = $('#filter-tanggal');

        // // Basic
        // if (bsRangePickerBasic.length) {
        //     bsRangePickerBasic.daterangepicker({
        //         opens: isRtl ? 'left' : 'right'
        //     });
        //     console.log(bsRangePickerBasic.val());
        // }

    });

    let barang = $('#filter-barang').val(),
        tanggal = $('#filter-tanggal').val();

    $(".filter").on('change', function() {
        barang = $('#filter-barang').val()
        tanggal = $('#filter-tanggal').val()
        // console.log(barang);

        $('#masuk-table').DataTable().ajax.reload(null, false);
    })



    function addRows() {
        var table = document.getElementById('dynamic_form');
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length;
        var row = table.insertRow(rowCount);
        for (var i = 0; i <= cellCount; i++) {
            var cell = 'cell' + i;
            cell = row.insertCell(i);
            var copycel = document.getElementById('col' + i).innerHTML;
            cell.innerHTML = copycel;
        }
    }

    function deleteRows() {
        var table = document.getElementById('dynamic_form');
        var rowCount = table.rows.length;
        if (rowCount > '3') {
            var row = table.deleteRow(rowCount - 1);
            rowCount--;
            // remove form value
            $('#dynamic_form').find('input[name="tanggal[]"]').eq(rowCount - 1).val('');
            $('#dynamic_form').find('input[name="stok_masuk[]"]').eq(rowCount - 1).val('');
            $('#dynamic_form').find('select[name="id_barang[]"]').eq(rowCount - 1).val('');
        } else {
            alert('Oopss..! Baris ini tidak dapat dihapus');
        }
    }
</script>
@endsection