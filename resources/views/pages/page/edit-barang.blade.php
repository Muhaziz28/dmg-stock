<div class="modal fade editBarang" id="editBarangModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Edit Barang</h3>
                    <p>Form edit barang.</p>
                </div>
                <form class="needs-validation" action="{{ route('dmg.updateBarang') }}" method="POST" id="edit-barang-form">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="col-12 mb-3">
                        <label class="form-label" for="nama_barang">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="Nama Barang" autofocus required />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="kode_barang">Kode Barang</label>
                        <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Kode Barang" autofocus required />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="ukuran">Ukuran</label>
                        <input type="text" id="ukuran" name="ukuran" class="form-control" placeholder="Ukuran" autofocus required />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="id_variasi">Variasi</label>
                        <select id="id_variasi" name="id_variasi" required class="form-select form-select" data-allow-clear="true">
                            <option value="">--Pilih variasi--</option>
                            @foreach ($variasis as $var )
                            <option value="{{ $var->id }}">{{ $var->nama_variasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="id_bahan">Bahan</label>
                        <select id="id_bahan" name="id_bahan" required class="form-select form-select" data-allow-clear="true">
                            <option value="">--Pilih bahan--</option>
                            @foreach ($bahans as $bahan )
                            <option value="{{ $bahan->id }}">{{ $bahan->nama_bahan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="stok">Stok</label>
                        <input type="text" id="stok" name="stok" class="form-control" placeholder="Stok" autofocus required />
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