<div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <form action="" method="post">
            @csrf
            @method('post')
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Medium Modal
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_produk">Nama Supplier :</label>
                            <input type="text" class="form-control mt-2" name="nama" id="nama" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga_jual">Telephone :</label>
                            <input type="number" class="form-control mt-2" name="telepon" id="telepon" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="nama_produk">Alamat :</label>
                        <textarea id="alamat" class="form-control" name="alamat" rows="3"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-light-primary text-primary font-medium waves-effect">
                    Simpan
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
            </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
