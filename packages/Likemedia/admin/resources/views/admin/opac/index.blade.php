@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item active" aria-current="gallery">Opac API </li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Opac API </h3>
</div>

<div class="alert alert-warning text-center alert-block">
    Please wait..<br>
    do not reload the page until the process is completed
    <div class="">
        <img src="/soledy/admin/4V0b.gif">
    </div>
</div>

<div class="card card-block">
    <div class="row">
        <div class="col-md-12">
            <h6>Items Synch:</h6>
        </div>
        <div class="col-md-4">
            <label for="">Opac > System Synch</label>
            <a  href="/back/opac-get-products-synch"
                class="btn btn-primary btn-block run-alert"
                onclick="return confirm('Are you sure you want to Synch all items?');">
                Run
            </a>
        </div>
    </div>
    <hr><hr>
</div>

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>

<style media="screen">
    .alert-block{
        display: none;
        position: relative;
    }
    .alert-block img{
        width: 50px;
        position: absolute;
        right: 10px;
        top: 10px;
    }
</style>
<script>
    $('.run-alert').on('click', function(){
        $('.alert-block').show();
    });
</script>
@stop
