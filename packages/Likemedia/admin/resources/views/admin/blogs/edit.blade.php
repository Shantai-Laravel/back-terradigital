@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('blog-categories.index') }}">Blogs</a></li>
        <li class="breadcrumb-item active" aria-current="blog">Edit blog</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Edit blog </h3>
    @include('admin::admin.list-elements', [
        'actions' => [
                "Add new" => route('blogs.create', ['category' => $blog->category_id]),
            ]
    ])
</div>
@include('admin::admin.alerts')
<div class="list-content">
    <div class="card">
        <div class="card-block">
            <form class="form-reg" role="form" method="POST" action="{{ route('blogs.update', $blog->id) }}" id="add-form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                @if ($blog->type == 'link')

                @else
                    <div class="row">
                        <div class="col-md-12">
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
                                @foreach($blog->translations as $translation)
                                    @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                    <div class="form-group">
                                        <label for="name-{{ $lang->lang }}">Title [{{ $lang->lang }}]</label>
                                        <input type="text" name="title_{{ $lang->lang }}" class="form-control" value="{{ $translation->name }}">
                                    </div>
                                    @endif
                                @endforeach
                                @foreach($blog->translations as $translation)
                                    @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                    <div class="form-group">
                                        <label for="descr-{{ $lang->lang }}">Description [{{ $lang->lang }}]</label>
                                        <textarea name="description_{{ $lang->lang }}" class="form-control">{{ $translation->description }}</textarea>
                                    </div>
                                    @endif
                                @endforeach
                                @foreach($blog->translations as $translation)
                                    @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                    <div class="form-group">
                                        <label for="body_{{ $lang->lang }}">Body [{{ $lang->lang }}]</label>
                                        <textarea  name="body_{{ $lang->lang }}" id="body-{{ $lang->lang }}" class="form-control">{{ $translation->body }}</textarea>
                                        <script>
                                            CKEDITOR.replace('body-{{ $lang->lang }}', {
                                                language: '{{$lang}}',
                                                height: '200px'
                                            });
                                        </script>
                                    </div>
                                    @endif
                                @endforeach
                                @foreach($blog->translations as $translation)
                                    @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                    <div class="form-group">
                                        <label for="seo_text-{{ $lang->lang }}">Link [{{ $lang->lang }}]</label>
                                        <textarea name="seo_text_{{ $lang->lang }}" class="form-control">{{ $translation->seo_text }}</textarea>
                                    </div>
                                    @endif
                                @endforeach

                                <li>
                                    @foreach($blog->translations as $translation)
                                    @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                        @if ($translation->banner)
                                        <img src="{{ asset('images/blogs/'. $translation->banner ) }}" style="height:100px;"><br>
                                        <input type="hidden" name="old_image_{{ $lang->lang }}" value="{{ $translation->banner }}"/>
                                        @else
                                            <img src="{{ asset('admin/img/noimage.jpg') }}" style="height:100px;">
                                        @endif
                                    @endif
                                    @endforeach

                                    <label for="img-{{ $lang->lang }}">Image [{{ $lang->lang }}]</label><br>
                                    <input type="file" name="image_{{ $lang->lang }}" id="img-{{ $lang->lang }}"/>
                                </li>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="img">Blog Picture</label>
                                <input type="file" name="picture" id="img"/>
                                <br>
                                @if ($blog->image)
                                    <img src="{{ asset('images/blogs/'. $blog->image ) }}" style="width: 60%;">
                                    <input type="hidden" name="picture_old" value="{{ $blog->image }}"/>
                                @else
                                    <img src="{{ asset('/admin/img/noimage.jpg') }}" style="width: 60%;">
                                @endif
                                <hr>
                            </div>
                        </div> --}}
                    </div>
                @endif
                <div class="form-group">
                    <input type="hidden" name="category_id" value="{{ $blog->category_id }}">
                    <input type="submit" value="{{trans('variables.save_it')}}" class="btn btn-primary">
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
