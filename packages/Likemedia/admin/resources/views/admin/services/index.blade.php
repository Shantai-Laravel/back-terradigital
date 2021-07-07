@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item active" aria-current="set">Returns </li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title">Services Extended</h3>
</div>

@include('admin::admin.alerts')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-block">
                <h6>Accordions:</h6>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Key</th>
                            <th>Service Category</th>
                            <th>Features</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accordions as $key => $accordion)
                            <tr>
                                <th>#</th>
                                <th>{{ $accordion->translation->title }}</th>
                                <th><small><i>{{ $accordion->key }}</i></small> </th>
                                <th><small>{{ $accordion->service->translation->name }}</small> </th>
                                <th><small><i>{{ $accordion->children->count() }}</i></small> </th>
                                <th>
                                    <a href="{{ url('/back/service/edit/' . $accordion->id) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </th>
                                <th>
                                    <a href="{{ url('/back/service/delete/' . $accordion->id) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-block">
                <h6>Add New:</h6>
                <form action="{{ url('/back/services') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Service Category:</label>
                        <select class="form-control" name="service_id">
                            @foreach ($services as $key => $oneService)
                                <option value="{{ $oneService->id }}">{{ $oneService->translation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Key: </label>
                        <input class="form-control" name="key" required/>
                    </div>
                    @foreach ($langs as $key => $oneLang)
                        <div class="form-group">
                            <label>Title[{{ $oneLang->lang }}]: </label>
                            <input class="form-control" name="title_{{ $oneLang->lang }}" required/>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
