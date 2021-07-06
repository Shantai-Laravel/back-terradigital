@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Services</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Services </h3>
</div>

<a href="{{ url('/back/services') }}" class="btn btn-primary">Extended Services</a>

<div id="cover">

    <blog-categories-add-new :langs="{{ $langs }}"></blog-categories-add-new>

    <blog-categories :langs="{{ $langs }}"></blog-categories>

</div>
<script src="{{asset('/admin/js/app_admin.js?'.uniqid())}}"></script>
<link rel="stylesheet" href="{{ asset('admin/css/nestable.css') }}">
@stop
