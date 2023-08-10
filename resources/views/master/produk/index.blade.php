@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="m-0">List Produk</h2>
                <div class="w-auto ms-2 float-end">
                    <button type="button" class="btn btn-rounded btn-success" onclick="addForm('{{route('produk.store')}}')">
                        <i class="ti ti-plus fs-4 me-1"></i>
                        Tambah
                    </button>
                <button type="button" class="btn btn-rounded btn-danger" onclick="deleteSelected('{{route('produk.deleteSelected')}}')">
                    <i class="ti ti-trash fs-4 me-1"></i>
                    Hapus
                </button>
                    <button type="button" class="btn btn-rounded btn-primary" onclick="addForm('{{route('produk.store')}}')">
                        <i class="ti ti-printer fs-4 me-1"></i>
                        Cetak Barcode
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <form action="" class="form-produk">
                                @csrf
                                <table id="datatable" class="table border table-striped table-bordered text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="select_all" id="select_all">
                                        </th>
                                        <th width="5%">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Merk</th>
                                        <th>Harga beli</th>
                                        <th>Harga Jual</th>
                                        <th>Diskon</th>
                                        <th>Stok</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @includeIf('master.produk.form')
@endsection
@push('scripts')
    <script>
        let table;
        $(function() {
           table = $('.table').DataTable({
               processing: true,
               autoWidth: false,
               ajax:{
                   url:'{{route('produk.data')}}',
               },
               columns: [
                   { data: 'select_all' },
                   { data: 'DT_RowIndex', searchable: false, sortable: false },
                   { data: 'kode_produk' },
                   { data: 'nama_produk' },
                   { data: 'nama_kategori' },
                   { data: 'merk' },
                   { data: 'harga_beli' },
                   { data: 'harga_jual' },
                   { data: 'diskon' },
                   { data: 'stok' },
                   { data: 'Action', searchable: false, sortable: false },
               ]
            });
            $('#addModal').validator().on('submit', function (e){
                var form = $('#addModal form');

                if(! e.preventDefault()){
                    $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize()
                    })
                        .done((response)=>{
                            $('#addModal').modal('hide');
                            toastr.success('Proses berhasil dijalankan', 'Sukses', {
                                closeButton: true,
                                tapToDismiss: false,
                                positionClass: 'toast-top-center'
                            });
                        table.ajax.reload();
                    })
                        .fail((errors)=>{
                            toastr.error('Terjadi kesalahan saat mengupdate data', 'Error', {
                                closeButton: true,
                                tapToDismiss: false,
                                positionClass: 'toast-top-center'
                            });
                        return;
                    });
                }
            });

            $('[name="select_all"]').on('click', function (){
                $(':checkbox').prop('checked', this.checked);
            })
        });
        function addForm(url){
            $('#addModal').modal('show');
            $('#addModal .modal-title').text('Tambah Produk');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('post');

            $('#addModal [name=nama_produk]').focus();
        }

        function editForm(url){
            $('#addModal').modal('show');
            $('#addModal .modal-title').text('Edit Produk');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('put');

            $('#addModal [name=nama_produk]').focus();

            $.get(url+'/edit').done((response)=>{
                $('#addModal [name=nama_produk]').val(response.nama_produk);
                $('#addModal [name=id_kategori]').val(response.id_kategori);
                $('#addModal [name=harga_beli]').val(response.harga_beli);
                $('#addModal [name=harga_jual]').val(response.harga_jual);
                $('#addModal [name=merk]').val(response.merk);
                $('#addModal [name=diskon]').val(response.diskon);
                $('#addModal [name=stok]').val(response.stok);
            }).fail((errors)=>{
                alert('tidak ada  data');
                return;
            })
        }

        function deleteData(url){
            Swal.fire({
                title: 'Yakin hapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    }).done((response) => {
                        Swal.fire('Data Berhasil dihapus', '', 'success');
                        table.ajax.reload();
                    }).fail((errors) => {
                        Swal.fire('Gagal menghapus data', '', 'error');
                    });
                }
            });
        }

        function deleteSelected(url){
            if($('input:checked').length > 1){
                Swal.fire({
                    title: 'Yakin hapus data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post(url, $('.form-produk').serialize())
                            .done((response) => {
                            Swal.fire('Data Berhasil dihapus', '', 'success');
                            table.ajax.reload();
                        }).fail((errors) => {
                            Swal.fire('Gagal menghapus data', '', 'error');
                            return;
                        });
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih data yang akan dihapus!',
                })
                return;
            }
        }
    </script>
@endpush
