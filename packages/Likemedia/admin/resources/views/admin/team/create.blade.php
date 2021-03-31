@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Team</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Member</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Create Member </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
            "Add new" => route('team.create'),
        ]
    ])
</div>
@include('admin::admin.alerts')

<div class="list-content">
    <div class="card">
        <div class="card-block">
            <form class="form-reg" role="form" method="POST" action="{{ route('team.store') }}" id="add-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-area">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                @if (!empty($langs))
                                @foreach ($langs as $lang)
                                <li class="nav-item">
                                    <a href="#{{ $lang->lang }}" class="nav-link  {{ $loop->first ? ' open active' : '' }}"
                                        data-target="#{{ $lang->lang }}">{{ $lang->lang }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>

                        @if (!empty($langs))
                        @foreach ($langs as $lang)
                        <div class="tab-content {{ $loop->first ? ' active-content' : '' }}" id={{ $lang->lang }}>
                            <div class="form-group">
                                <label for="name-{{ $lang->lang }}">Name [{{ $lang->lang }}]</label>
                                <input type="text" name="name_{{ $lang->lang }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="function-{{ $lang->lang }}">Function [{{ $lang->lang }}]</label>
                                <input type="text" name="function_{{ $lang->lang }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email-{{ $lang->lang }}">Email [{{ $lang->lang }}]</label>
                                <input type="text" name="email_{{ $lang->lang }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone-{{ $lang->lang }}">Phone [{{ $lang->lang }}]</label>
                                <input type="number" name="phone_{{ $lang->lang }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="info-{{ $lang->lang }}">Info [{{ $lang->lang }}]</label>
                                <textarea name="info_{{ $lang->lang }}" class="form-control"></textarea>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alias">Department</label>
                            <select class="form-control" name="department_id">
                                @if (!empty($departments))
                                    <option value="0">----</option>
                                    @foreach ($departments as $key => $department)
                                        <option value="{{ $department->id }}">{{ $department->translation->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <hr>

                        <div class="">
                            <label>Avatar</label>
                            <input type="file" name="image"/> <br>
                            <img src="{{ asset('admin/img/noimage.jpg') }}" width="70%">
                            <hr>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" value="Save"class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
