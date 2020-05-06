@extends('layouts.template')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Data Carousel</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Carousel</h5>
                </div>
                <div class="card-body">
                    @include('layouts.success')
                    <a href="{{route('carousel.create')}}" class="btn btn-lg btn-primary"><i data-feather="plus-circle" class="align-middle"></i> <span class="align-middle">Tambah Data</span></a>
                    <hr>
                    <table id="tableCarousel" class="table table-striped table-hover table-bordered nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Keterangan/ Caption</th>
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
        table = $('#tableCarousel').DataTable({
            processing: true,
            searching: true,
            language: {
                processing: 'Sedang Memuat Data...'
            },
            order: [],
            serverSide: true,
            ajax: {
                url: "{{route('carousel.index')}}"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                {
                    data: 'carousel',
                    name: 'carousel'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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

    function deleteCarousel(token, kd_carousel){
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
                    url: '{{ url('carousel') }}/'+kd_carousel,
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
