@extends('pages.page.layout')

@section('title', 'Data Variasi Barang')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">Data Variasi Barang</h4>

        <div class="mb-4">
            <div class="alert alert-info d-flex" role="alert">
                <span class="badge badge-center rounded-pill border-label-info bg-info p-3 me-2"><i class="bx bxs-alarm-exclamation fs-6"></i></span>
                <div class="d-flex flex-column ps-1">
                    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Perhatian!!</h6>
                    <span>Data variasi terhubung dengan data barang, setiap nama variasi diubah, akan mengubah variasi yang tersimpan pada data barang!</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-variasi table border-top" id="variasi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ket</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->

        <!-- Modal -->
        <div class="modal fade" id="variasiModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Tambah Variasi Baru</h3>
                            <p>Form tambah variasi.</p>
                        </div>
                        <form class="needs-validation" action="{{ route('dmg.addVariasi') }}" method="POST" id="add-variasi-form">
                            @csrf
                            <div class="col-12 mb-3">
                                <label class="form-label" for="nama_variasi">Nama Variasi</label>
                                <input type="text" id="nama_variasi" name="nama_variasi" class="form-control" placeholder="Nama Divisi" autofocus required />
                            </div>
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan"></textarea>
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
@include('pages.page.edit-variasi')
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

        $('#add-variasi-form').submit(function(e) {
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
                    $('#add-variasi-form button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        toastr.success(data.msg, 'Error!');
                    } else {
                        $(form)[0].reset();
                        // alert(data.msg);
                        $('#variasiModal').modal('hide');
                        $('#variasi-table').DataTable().ajax.reload(null, false);
                        $('#add-variasi-form button[type="submit"]').html('Save');
                        // show toastr with animation
                        toastr.success(data.msg, 'Success!');
                    }
                }
            })
        });

        // ! GET VARIASI
        var table = $('.datatables-variasi')

        if (table.length) {
            dt_divisi = table.DataTable({
                ajax: '{{ route("dmg.getVariasi") }}',
                listView: {
                    layout: true,
                    columnFilters: false,
                    checkbox: false,
                    checkboxTemplate: '<input type="checkbox">',
                    grid: true,
                    gridTemplate: 'col-xs-12 col-sm-6 col-md-3 col-lg-2'
                },
                serverSide: true,
                processing: true,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama_variasi',
                        name: 'nama_variasi',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
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
                    text: 'Tambah Variasi',
                    className: 'add-new btn btn-primary mb-3 mb-md-0',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#variasiModal',
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }],
            });
        }

        // ! DETAIL VARIASI 
        $(document).on('click', '#editVariasi', function() {
            var variasi_id = $(this).data('id');
            // alert(divisi_id);
            $('.editVariasi').find('form')[0].reset();
            $('.editVariasi').find('span.error-text').text('');
            $.post('<?= route('dmg.detailVariasi') ?>', {
                variasi_id: variasi_id
            }, function(data) {
                // alert(data.details.nama_divisi);
                $('.editVariasi').find('input[name="id"]').val(data.details.id);
                $('.editVariasi').find('input[name="nama_variasi"]').val(data.details.nama_variasi);
                $('.editVariasi').find('textarea[name="keterangan"]').val(data.details.keterangan);
                $('.editVariasi').modal('show');
            }, 'json');
        });

        // ! UPDATE VARIASI
        $('#edit-variasi-form').on('submit', function(e) {
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
                    $('#edit-variasi-form button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#variasi-table').DataTable().ajax.reload(null, false);
                        $('#edit-variasi-form button[type="submit"]').html('Save');
                        $('.editVariasi').modal('hide');
                        $('.editVariasi').find('form')[0].reset();
                        toastr.success(data.msg, 'Success!');
                    }
                }
            });
        });

        // ! DELETE VARIASI
        $(document).on('click', '#deleteVariasi', function() {
            var variasi_id = $(this).data('id');
            var url = '<?= route("dmg.deleteVariasi") ?>';

            swal.fire({
                title: 'Data akan dihapus?',
                html: 'data variasi akan <b>dihapus</b>',
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
                        variasi_id: variasi_id
                    }, function(data) {
                        if (data.code == 1) {
                            $('#variasi-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg, 'Success!');
                        } else {
                            toastr.error(data.msg, 'Error!');
                        }
                    }, 'json');
                }
            });
        })

    });
</script>
@endsection