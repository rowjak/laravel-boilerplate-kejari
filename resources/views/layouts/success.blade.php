@if(session('status'))
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
    <div class="alert-icon">
        <i class="far fa-fw fa-bell"></i>
    </div>
    <div class="alert-message">
        <strong>Berhasil!</strong> {{session('status')}}
    </div>
</div>
@endif
