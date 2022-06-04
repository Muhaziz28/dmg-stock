@extends('pages.page.layout')

@section('title', 'DMG STOCK')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 order-0 mb-4">
            <div class="card">
                <div class="row d-flex align-items-end">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">NEW DMG STOCK! 🎉</h5>
                            <p class="mb-4">
                                Aplikasi manajemen stok barang masuk dan keluar
                            </p>

                            <a href="javascript:;"> </a>
                        </div>
                    </div>
                    <div class="text-sm-left col-sm-5 text-center">
                        <div class="card-body px-0 px-md-4 pb-0">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title m-0 me-2">Stok Masuk</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm p-0">
                            <?= date('d M Y') ?>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-title me-2 mb-1 text-success">+ {{ $masuk }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title m-0 me-2">Stok Keluar</h6>
                    <div class="dropdown">
                        <button class="btn btn-sm p-0">
                            <?= date('d M Y') ?>
                        </button>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h3 class="card-title me-2 mb-1 text-success">- {{ $keluar }}</h3>
                </div>
            </div>
        </div>
    </div>
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
</script>
@endsection