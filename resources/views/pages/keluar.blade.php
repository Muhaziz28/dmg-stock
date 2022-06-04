@extends('pages.page.layout')

@section('title', 'Data Barang Keluar')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-2">Data Barang Keluar</h4>



        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-keluar table border-top" id="keluar-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Keluar</th>
                            <th>Stok Keluar</th>
                            <th>Barang</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->

        <!-- Modal -->
        <div class="modal fade" id="keluarModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Tambah Bahan Baru</h3>
                            <p>Form tambah bahan.</p>
                        </div>
                        <form class="needs-validation" action="{{ route('dmg.addKeluar') }}" method="POST" id="add-keluar-form">
                            @csrf
                            <div class="col-12  mb-4">
                                <label for="tanggal" class="form-label">Tanggal Keluar</label>
                                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="tanggal" id="tanggal" required />
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
                                <label for="stok_keluar" class="form-label">Stok Keluar</label>
                                <input type="number" class="form-control" placeholder="Stok Masuk" id="stok_keluar" name="stok_keluar" required />
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

        $('#add-keluar-form').submit(function(e) {
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
                    $('#add-keluar-form button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        toastr.success(data.msg, 'Error!');
                    } else {
                        $(form)[0].reset();
                        // alert(data.msg);
                        $('#keluarModal').modal('hide');
                        $('#keluar-table').DataTable().ajax.reload(null, false);
                        $('#add-keluar-form button[type="submit"]').html('Save');
                        toastr.success(data.msg, 'Success!');
                    }
                }
            })
        });

        // ! GET VARIASI
        var table = $('.datatables-keluar')

        if (table.length) {
            dt_divisi = table.DataTable({
                ajax: '{{ route("dmg.getKeluar") }}',
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
                        data: 'tanggal',
                        name: 'tanggal',
                        render: function(data, type, row) {
                            return moment(data).format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'stok_keluar',
                        name: 'stok_keluar',
                        render: function(data, type, row) {
                            return '- ' + data + "pcs";
                        }
                    },
                    {
                        data: 'barang.nama_barang',
                        name: 'barang.nama_barang',
                        render: function(data, type, row) {
                            return row.barang.nama_barang + ', KODE BRG: ' + '<span class="text-primary">' + row.barang.kode_barang + '</span>' + ', STOK AKHIR: ' + '<span class="text-primary">' + row.stok_awal + '</span>';
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
                    searchPlaceholder: 'Search..'
                },
                // Buttons with Dropdown
                buttons: [{
                    text: 'Tambah Barang Keluar',
                    className: 'add-new btn btn-primary mb-3 mb-md-0',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#keluarModal',
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }],
            });
        }

        // ! DETAIL BAHAN 
        $(document).on('click', '#editBahan', function() {
            var bahan_id = $(this).data('id');
            // alert(divisi_id);
            $('.editBahan').find('form')[0].reset();
            $('.editBahan').find('span.error-text').text('');
            $.post('<?= route('dmg.detailBahan') ?>', {
                bahan_id: bahan_id
            }, function(data) {
                // alert(data.details.nama_divisi);
                $('.editBahan').find('input[name="id"]').val(data.details.id);
                $('.editBahan').find('input[name="nama_bahan"]').val(data.details.nama_bahan);
                $('.editBahan').find('textarea[name="keterangan"]').val(data.details.keterangan);
                $('.editBahan').modal('show');
            }, 'json');
        });

        // ! UPDATE BAHAN
        $('#edit-bahan-form').on('submit', function(e) {
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
                    $('#edit-bahan-form button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $('#masuk-table').DataTable().ajax.reload(null, false);
                        $('#edit-bahan-form button[type="submit"]').html('Save');
                        $('.editBahan').modal('hide');
                        $('.editBahan').find('form')[0].reset();
                        toastr.success(data.msg, 'Success!');
                    }
                }
            });
        });

        // ! DELETE BAHAN
        $(document).on('click', '#deleteBahan', function() {
            var bahan_id = $(this).data('id');
            var url = '<?= route("dmg.deleteBahan") ?>';

            swal.fire({
                title: 'Data akan dihapus?',
                html: 'data bahan akan <b>dihapus</b>',
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
                        bahan_id: bahan_id
                    }, function(data) {
                        if (data.code == 1) {
                            $('#masuk-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg, 'Success!');
                        } else {
                            toastr.error(data.msg, 'Error!');
                        }
                    }, 'json');
                }
            });
        })

    });

    var tanggal = document.getElementById('tanggal');
    if (tanggal) {
        flatpickr(tanggal, {
            altInput: true,
            altFormat: " F j Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                // console.log(selectedDates);
                // console.log(dateStr);
                // console.log(instance);
            }
        });
    }
</script>
@endsection