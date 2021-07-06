@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/back/services') }}">Services Extended </a></li>
        <li class="breadcrumb-item active" aria-current="set">{{ $accordion->translation->title }}</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title">Services Extended</h3>
</div>

@include('admin::admin.alerts')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-block">
                <h6>Edit:</h6>
                <form action="{{ url('/back/service/'.$accordion->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Service Category:</label>
                        <select class="form-control" name="service_id">
                            @foreach ($services as $key => $oneService)
                                <option value="{{ $oneService->id }}" {{ $oneService->id === $accordion->service_id ? 'selected' : ''}}>
                                    {{ $oneService->translation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Key: </label>
                        <input class="form-control" name="key" required value="{{ $accordion->key }}"/>
                    </div>
                    @foreach ($langs as $key => $oneLang)

                        @foreach($accordion->translations as $translation)
                            @if($translation->lang_id == $oneLang->id && !is_null($translation->lang_id))
                            <div class="form-group">
                                <label>Title [{{ $lang->lang }}]</label>
                                <input class="form-control" name="title_{{ $oneLang->lang }}" required value="{{ $translation->title }}"/>
                            </div>
                            @endif
                        @endforeach
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
