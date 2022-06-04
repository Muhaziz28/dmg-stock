@extends('pages.page.layout')

@section('title', 'Data Stok Barang')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">Data Stock Barang</h4>



        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-barang table border-top" id="barang-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Nota</th>
                            <th>Ukuran</th>
                            <th>Bahan</th>
                            <th>Variasi</th>
                            <th>Stok</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->

        <!-- Modal -->
        <div class="modal fade" id="barangModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable" role="document">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Tambah Barang Baru</h3>
                            <p>Form tambah jabatan.</p>
                        </div>
                        <form class="needs-validation" action="{{ route('dmg.addBarang') }}" method="POST" id="add-barang-form">
                            @csrf
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered" id="dynamic_form">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" style="vertical-align: middle; text-align: center;">Kode Barang <span class="text-danger">*</span></th>
                                            <th scope="col" colspan="2" style="vertical-align: middle; text-align: center;">Data Barang<span class="text-danger">*</span></th>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Ukuran</th>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Bahan</th>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Stok</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Nama Barang</th>
                                            <th scope="col" style="vertical-align: middle; text-align: center;" rowspan="2">Variasi <span class="text-danger">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td id="col0">
                                                <div class="input-group">
                                                    <input class="form-control" required type="text" name="kode_barang[]" placeholder="Kode Barang" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                </div>
                                            </td>
                                            <td id="col1">
                                                <div class="input-group">
                                                    <input class="form-control" required type="text" name="nama_barang[]" placeholder="Nama Barang" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                </div>
                                            </td>
                                            <td id="col2">
                                                <div class="input-group">
                                                    <select id="id_variasi" name="id_variasi[]" required class="form-select form-select" data-allow-clear="true">
                                                        <option value="">--Pilih variasi--</option>
                                                        @foreach ($variasis as $var )
                                                        <option value="{{ $var->id }}">{{ $var->nama_variasi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <!-- <input class="form-control" required type="text" name="bahan[]" placeholder="Bahan" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span> -->
                                                </div>

                                            </td>
                                            <td id="col3">
                                                <div class="input-group">
                                                    <input class="form-control" required type="text" name="ukuran[]" placeholder="Ukuran" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                </div>
                                            </td>
                                            <td id="col4">
                                                <div class="input-group">
                                                    <select id="id_bahan" name="id_bahan[]" required class="form-select form-select" data-allow-clear="true">
                                                        <option value="">--Pilih bahan--</option>
                                                        @foreach ($bahans as $bahan )
                                                        <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                            <td id="col5">
                                                <div class="input-group">
                                                    <input class="form-control" required type="number" name="stok[]" placeholder="Stok" autocomplete="off"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
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
        </div>

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
<!-- Content wrapper -->
@include('pages.page.edit-barang')
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
        $('#add-barang-form').on('submit', function(e) {
            e.preventDefault();
            // alert('hello form');
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'JSON',
                contentType: false,
                beforeSend: function() {
                    $('#barangModal').find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        toastr.success(data.msg, 'Error!');
                    } else {
                        $(form)[0].reset();
                        // alert(data.msg);
                        $('#barangModal').find('button[type="submit"]').html('Save');
                        $('#barangModal').modal('hide');
                        // reset form
                        $('#barang-table').DataTable().ajax.reload(null, false);
                        toastr.success(data.msg);
                    }
                }
            });
        });
        // ! DETAIL BARANG 
        $(document).on('click', '#editBarang', function() {
            var barang_id = $(this).data('id');
            // alert(divisi_id);
            $('.editBarang').find('form')[0].reset();
            $('.editBarang').find('span.error-text').text('');
            $.post('<?= route('dmg.detailBarang') ?>', {
                barang_id: barang_id
            }, function(data) {
                // alert(data.details.nama_divisi);
                $('.editBarang').find('input[name="id"]').val(data.details.id);
                $('.editBarang').find('input[name="nama_barang"]').val(data.details.nama_barang);
                $('.editBarang').find('input[name="kode_barang"]').val(data.details.kode_barang);
                $('.editBarang').find('input[name="ukuran"]').val(data.details.ukuran);
                $('.editBarang').find('select[name="id_bahan"]').val(data.details.id_bahan);
                $('.editBarang').find('select[name="id_variasi"]').val(data.details.id_variasi);
                $('.editBarang').find('input[name="stok"]').val(data.details.stok);
                $('.editBarang').find('textarea[name="keterangan"]').val(data.details.keterangan);
                $('.editBarang').modal('show');
            }, 'json');
        });

        // ! UPDATE BARANG
        $('#edit-barang-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $('#edit-barang-form button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#barang-table').DataTable().ajax.reload(null, false);
                        $('#edit-barang-form button[type="submit"]').html('Save');
                        $('.editBarang').modal('hide');
                        $('.editBarang').find('form')[0].reset();
                        toastr.success(data.msg, 'Success!');
                    }
                }
            });
        });
        // ! GET barang
        var table = $('.datatables-barang')

        if (table.length) {
            dt_divisi = table.DataTable({
                ajax: '{{ route("dmg.getBarang") }}',
                listView: {
                    layout: true,
                    columnFilters: false,
                    checkbox: false,
                    checkboxTemplate: '<input type="checkbox">',
                    grid: true,
                    gridTemplate: 'col-xs-12 col-sm-6 col-md-3 col-lg-2'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang',
                    },
                    {
                        data: 'kode_barang',
                        name: 'kode_barang',
                    },
                    {
                        data: 'ukuran',
                        name: 'ukuran',
                    },
                    {
                        data: 'bahan.nama_bahan',
                        name: 'bahan.nama_bahan',
                    },
                    {
                        data: 'variasi.nama_variasi',
                        name: 'variasi.nama_variasi'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                    }
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
                    searchPlaceholder: 'Search..'
                },
                // Buttons with Dropdown
                buttons: [{
                    text: 'Tambah Barang',
                    className: 'add-new btn btn-primary mb-3 mb-md-0',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#barangModal',
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }],
            });
        }

        // ! DELETE BARANG
        $(document).on('click', '#deleteBarang', function() {
            var barang_id = $(this).data('id');
            var url = '<?= route("dmg.deleteBarang") ?>';

            swal.fire({
                title: 'Data akan dihapus?',
                html: 'data barang akan <b>dihapus</b>',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                // width: '300px',
                allowOutsideClick: false,
                backdrop: false,
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {
                        barang_id: barang_id
                    }, function(data) {
                        if (data.code == 1) {
                            $('#barang-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg, 'Success!');
                        } else {
                            toastr.error(data.msg, 'Error!');
                        }
                    }, 'json');
                }
            });
        })

    });

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
        } else {
            alert('Oopss..! Baris ini tidak dapat dihapus');
        }
    }
</script>
@endsection