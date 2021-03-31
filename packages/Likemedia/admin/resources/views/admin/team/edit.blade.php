@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('team.index') }}">Team</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Team</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Edit Team </h3>
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
            <form class="form-reg" role="form" method="POST" action="{{ route('team.update', $team->id) }}" id="add-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="row">
                    <div class="col-md-9">
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
                            @foreach($team->translations as $translation)
                            @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                <div class="form-group">
                                    <label for="name_{{ $lang->lang }}">Name [{{ $lang->lang }}]</label>
                                    <input type="text" name="name_{{ $lang->lang }}" class="form-control" value="{{ $translation->name }}">
                                </div>
                            @endif
                            @endforeach

                            @foreach($team->translations as $translation)
                            @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                <div class="form-group">
                                    <label for="function_{{ $lang->lang }}">Function [{{ $lang->lang }}]</label>
                                    <input type="text" name="function_{{ $lang->lang }}" class="form-control" value="{{ $translation->function }}">
                                </div>
                            @endif
                            @endforeach

                            @foreach($team->translations as $translation)
                            @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                <div class="form-group">
                                    <label for="email_{{ $lang->lang }}">Email [{{ $lang->lang }}]</label>
                                    <input type="text" name="email_{{ $lang->lang }}" class="form-control" value="{{ $translation->email }}">
                                </div>
                            @endif
                            @endforeach

                            @foreach($team->translations as $translation)
                            @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                <div class="form-group">
                                    <label for="phone{{ $lang->lang }}">Phone [{{ $lang->lang }}]</label>
                                    <input type="number" name="phone_{{ $lang->lang }}" class="form-control" value="{{ $translation->phone }}">
                                </div>
                            @endif
                            @endforeach

                            @foreach($team->translations as $translation)
                                @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                    <div class="ckeditor form-group">
                                        <label>Info [{{ $lang->lang }}]</label>
                                        <textarea name="info_{{ $lang->lang }}" class="form-control">{!! $translation->info !!}</textarea>
                                    </div>
                                @endif
                            @endforeach

                    </div>
                    @endforeach
                    @endif
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="alias">Department:</label>
                            <select class="form-control" name="department_id">
                                <option value="0">---</option>
                                @if (!empty($departments))
                                    @foreach ($departments as $key => $department)
                                        <option {{ $department->id == $team->department_id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->translation->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="img">Avatar</label>
                            <input type="file" name="image" id="img"/>
                            <br>
                            @if ($team->image)
                                <img src="{{ asset('/images/team/'. $team->image ) }}" style="width: 70%;">
                                <input type="hidden" name="image_old" value="{{ $team->image }}"/>
                            @else
                                <img src="{{ asset('/admin/img/noimage.jpg') }}" style="width: 70%;">
                            @endif
                            <hr>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Save">
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
