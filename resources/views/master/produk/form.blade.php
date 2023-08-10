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
                            <label for="nama_produk">Nama Produk :</label>
                            <input type="text" class="form-control mt-2" name="nama_produk" id="nama_produk" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli">Harga Beli :</label>
                            <input type="number" class="form-control mt-2" name="harga_beli" id="harga_beli" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="merk">Merk Produk :</label>
                            <input type="text" class="form-control mt-2" name="merk" id="merk" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="stok">Stok Produk :</label>
                            <input type="number" class="form-control mt-2" name="stok" id="stok" value="0" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_kategori">Kategori :</label>
                            <select class="form-control mt-2" id="id_kategori" name="id_kategori" required>
                                <option value="">-- Pilih --</option>
                                @foreach($kategori as $key =>$item)
                                <option value="{{$key}}"> {{$item}}</option>
                                @endforeach
                            </select>
                            <span class="help-block has-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual">Harga Jual :</label>
                            <input type="number" class="form-control mt-2" name="harga_jual" id="harga_jual" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="diskon">Diskon :</label>
                            <input type="number" class="form-control mt-2" name="diskon" id="diskon" value="0" autofocus required>
                            <span class="help-block has-error"></span>
                        </div>
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
