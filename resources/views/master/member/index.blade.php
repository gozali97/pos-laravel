@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="m-0">List Member</h2>
                <div class="w-auto ms-2 float-end">
                    <button type="button" class="btn btn-rounded btn-success" onclick="addForm('{{route('member.store')}}')">
                        <i class="ti ti-plus fs-4 me-1"></i>
                        Tambah
                    </button>
{{--                <button type="button" class="btn btn-rounded btn-danger" onclick="deleteSelected('{{route('member.deleteSelected')}}')">--}}
{{--                    <i class="ti ti-trash fs-4 me-1"></i>--}}
{{--                    Hapus--}}
{{--                </button>--}}
                    <button type="button" class="btn btn-rounded btn-primary" onclick="cetakMember('{{route('member.cetakMember')}}')">
                        <i class="ti ti-credit-card fs-4 me-1"></i>
                        Cetak Kartu
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <form action="" method="post" class="form-member">
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
                                        <th>Alamat</th>
                                        <th>Telephone</th>
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

    @includeIf('master.member.form')
@endsection
@push('scripts')
    <script>
        let table;
        $(function() {
           table = $('.table').DataTable({
               processing: true,
               autoWidth: false,
               ajax:{
                   url:'{{route('member.data')}}',
               },
               columns: [
                   { data: 'select_all' },
                   { data: 'DT_RowIndex', searchable: false, sortable: false },
                   { data: 'kode_member' },
                   { data: 'nama' },
                   { data: 'alamat' },
                   { data: 'telepon' },
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
            $('#addModal .modal-title').text('Tambah Member');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('post');

            $('#addModal [name=nama]').focus();
        }

        function editForm(url){
            $('#addModal').modal('show');
            $('#addModal .modal-title').text('Edit Member');

            $('#addModal form')[0].reset();
            $('#addModal form').attr('action', url);
            $('#addModal [name=_method]').val('put');

            $('#addModal [name=nama]').focus();

            $.get(url+'/edit').done((response)=>{
                $('#addModal [name=nama]').val(response.nama);
                $('#addModal [name=telepon]').val(response.telepon);
                $('#addModal [name=alamat]').val(response.alamat);
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
                        $.post(url, $('.form-member').serialize())
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
        function cetakMember(url){
            if($('input:checked').length < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih data yang akan dicetak!',
                })
                return;

            }else{
                $('.form-member').attr('target', '_blank').attr('action', url).submit();

            }
        }

    </script>
@endpush
