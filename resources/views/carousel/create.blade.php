@extends('layouts.template')
@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Data Carousel</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Form Tambah Data Carousel <a href="{{route('carousel.index')}}" class="btn btn-warning float-right"><i class="fa fa-backspace"></i> Kembali</a></h5>
                    <h6 class="card-subtitle text-muted">Untuk menambah Carousel/ Gambar Berjalan Pada Halaman Utama.</h6>
                </div>
                <div class="card-body">
                    @include('errors.validator')
                    <form method="post" action="{{route('carousel.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-right">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" name="carousel" id="carousel" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-right">Caption/ Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" placeholder="Caption/ Keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-right">Link</label>
                            <div class="col-sm-10">
                                <input type="text" name="link" id="link" class="form-control" placeholder="Link">
                                <small style="color: blue">Cantumkan Lengkap Dengan Http/Https nya</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-2 text-sm-right">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control select2">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="Ditampilkan">Ditampilkan</option>
                                    <option value="Disembunyikan">Disembunyikan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
