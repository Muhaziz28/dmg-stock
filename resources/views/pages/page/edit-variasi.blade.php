<div class="modal fade editVariasi" id="editVariasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Edit Variasi</h3>
                    <p>Form edit variasi.</p>
                </div>
                <form class="needs-validation" action="{{ route('dmg.updateVariasi') }}" method="POST" id="edit-variasi-form">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="col-12 mb-3">
                        <label class="form-label" for="nama_variasi">Nama Variasi</label>
                        <input type="text" id="nama_variasi" name="nama_variasi" class="form-control" placeholder="Nama Variasi" autofocus required />
                    </div>
                    <div class="col-12 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan Divisi"></textarea>
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