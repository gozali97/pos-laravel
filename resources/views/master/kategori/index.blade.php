@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2>List Kategori</h2>
                <div class="w-auto ms-2">
                <button type="button" class="btn btn-rounded btn-success" onclick="addForm('{{route('kategori.store')}}')">
                    <i class="ti ti-plus fs-4 me-1"></i>
                    Tambah
                </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="datatable" class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Kategori</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @includeIf('master.kategori.form')
@endsection
@push('scripts')
    <script>
        let table;
        $(function() {
           table = $('.table').DataTable({
               processing: true,
               autoWidth: false,
               ajax:{
                   url:'{{route('kategori.data')}}',
               },
               columns: [
                   { data: 'DT_RowIndex', searchable: false, sortable: false },
                   { data: 'nama_kategori' },
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
                            toastr.error('Terjadi kesalahan saat menyimpan data', 'Error', {
                                closeButton: true,
                                tapToDismiss: false,
                                positionClass: 'toast-top-center'
                            });
                        return;
                    });
                }
            });
        });
        function addForm(url){
            $('#addModal').modal('show');
            $('#addModal .modal-title').text('Tambah Kategori');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('post');

            $('#addModal [name=nama_kategori]').focus();
        }

        function editForm(url){
            $('#addModal').modal('show');
            $('#addModal .modal-title').text('Edit Kategori');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('put');

            $('#addModal [name=nama_kategori]').focus();

            $.get(url+'/edit').done((response)=>{
                $('#addModal [name=nama_kategori]').val(response.nama_kategori);
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
    </script>
@endpush
