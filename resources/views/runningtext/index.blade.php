@extends('layouts.template')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Data Running Text</h1>

    <div class="row">
        <div class="col-12">
            <!-- BEGIN primary modal -->
            <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ubah Data Running Text</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="formUbahRunning">
                                <input type="hidden" id="e_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="e_kd_running_text">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="text">Running Text</label>
                                        <input type="text" class="form-control" id="etext" name="etext" placeholder="Running Text">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="status">Status</label>
                                        <select name="estatus" id="estatus" class="form-control select2">
                                            <option value="Ditampilkan">Ditampilkan</option>
                                            <option value="Disembunyikan">Disembunyikan</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" id="btnPerbarui" class="btn btn-info"><i class="fa fa-recycle"></i> Perbarui</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END primary modal -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Tambah Data Running Text</h5>
                </div>
                <div class="card-body pt-1">
                    <hr class="p-0 mt-1">
                    <form id="formTambahRunning">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="text">Running Text</label>
                                <input type="text" class="form-control" id="text" name="text" placeholder="Running Text">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control select2">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Ditampilkan">Ditampilkan</option>
                                    <option value="Disembunyikan">Disembunyikan</option>
                                </select>
                            </div>
                        </div>
                        <button id="btnSimpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Running Text Anjungan Mini Kejaksaan Negeri Batang</h5>
                </div>
                <div class="card-body pt-1">
                    @include('layouts.success')
                    <hr class="p-0 mt-0">
                    <table id="tableRunningtext" class="table table-striped table-hover table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>RunningText</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')

<script>
    var table;
    $(function(e){
        table = $('#tableRunningtext').DataTable({
            processing: true,
            searching: true,
            language: {
                processing: 'Sedang Memuat Data...'
            },
            order: [],
            serverSide: true,
            ajax: {
                url: "{{route('runningtext.index')}}"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                {
                    data: 'text',
                    name: 'text'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        })
    })



    $('#btnSimpan').click(function(e){
        e.preventDefault()
        $('#btnSimpan').empty()
        $('#btnSimpan').html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...')
        $('#btnSimpan').attr('disabled', true)
        $.post( "{{route('runningtext.store')}}", $( "#formTambahRunning" ).serialize(),function(data){
            $('#text').val('')
            $('#status').val('').trigger('change')
            $('#btnSimpan').empty()
            $('#btnSimpan').html('<i class="fa fa-save"></i> Simpan')
            $('#btnSimpan').attr('disabled', false)
            if (data.status) {
                Swal.fire({
                    title: "Informasi!",
                    text: data.message,
                    icon: "info"
                })
                table.draw()
            }else{
                Swal.fire({
                    html: data.message,
                    title: "Peringatan!",
                    icon: "warning"
                })
            }
        });
    })

    $('#btnPerbarui').click(function(e){
        $('#btnPerbarui').empty()
        $('#btnPerbarui').html('<i class="fa fa-spinner fa-spin"></i> Memperbarui...')
        $('#btnPerbarui').attr('disabled', true)
        $.ajax(
        {
            url: '{{ url('runningtext') }}/'+$('#e_kd_running_text').val(),
            type: 'PUT',
            data: {
                "_token": $('#e_token').val(),
                "text": $('#etext').val(),
                "status": $('#estatus').val()
            },
            success: function (data){
                $('#btnPerbarui').empty()
                $('#btnPerbarui').html('<i class="fa fa-refresh"></i> Perbarui')
                $('#btnPerbarui').attr('disabled', false)
                if (data.status) {
                    Swal.fire({
                        title: "Informasi!",
                        text: data.message,
                        icon: "info"
                    })
                    table.draw()
                    $('#modalUbah').modal('toggle')
                }else{
                    Swal.fire({
                        html: data.message,
                        title: "Peringatan!",
                        icon: "warning"
                    })
                }
            }
        });
    })

    function ubahRunningtext(kd_running_text){
        $.get( "{{url('runningtext')}}/"+kd_running_text+'/edit',function(data){
            $('#etext').val(data.text)
            $('#estatus').val(data.status).trigger('change')
            $('#e_kd_running_text').val(data.kd_running_text)
            $('#modalUbah').modal('toggle')
        });
    }

    function deleteRunningtext(token, kd_running_text){
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data Yang Sudah Dihapus Tidak Dapat Dikembalikan!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#F9354C",
            cancelButtonColor: "#41B314",
            confirmButtonText: "Ya, Saya Yakin!",
            cancelButtonText: "Batal"
        }).then(function(t) {
            if (t.value) {
                $.ajax(
                {
                    url: '{{ url('runningtext') }}/'+kd_running_text,
                    type: 'DELETE',
                    data: {
                        "_token": token,
                    },
                    success: function (data){
                        Swal.fire({
                            title: "Dihapus!",
                            text: data.message,
                            icon: "success"
                        })
                        table.draw()
                    }
                });
            }
        })
    }
</script>
@endsection
