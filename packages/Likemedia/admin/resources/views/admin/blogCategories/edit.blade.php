@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('blog-categories.index') }}">Services</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Edit Service </h3>
</div>

<div class="card">
    <div class="card-block">
        <div class="row">
            <form class="form-reg" method="post" action="{{ route('blog-categories.update', $category->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <div class="col-md-9">
                    <div class="tab-area">
                        @include('admin::admin.alerts')
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            @if (!empty($langs))
                            @foreach ($langs as $key => $lang)
                            <li class="nav-item">
                                <a href="#{{ $lang->lang }}" class="nav-link  {{ $key == 0 ? ' open active' : '' }}"
                                    data-target="#{{ $lang->lang }}">{{ $lang->lang }}</a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <input type="hidden" name="dependable-status" value="false">
                        <input type="hidden" name="submit-status" value="false">
                        @if (!empty($langs))
                        @foreach ($langs as $key => $lang)
                        <div class="tab-content {{ $key == 0 ? ' active-content' : '' }}" id={{ $lang->lang }}>
                            <div class="part full-part">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Title [{{ $lang->lang }}]</label>
                                            <input type="text" name="name_{{ $lang->lang }}" class="form-control"
                                            @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                            value="{{ $translation->name }}"
                                            @endif
                                            @endforeach
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        {{-- @foreach($category->translations as $translation)
                                        @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                        <div class="form-group">
                                            <label for="descr-{{ $lang->lang }}">Body [{{ $lang->lang }}]</label>
                                            <textarea name="description_{{ $lang->lang }}" id="body-{{ $lang->lang }}" class="form-control">{{ $translation->description }}</textarea>
                                        </div>
                                        <script>
                                            CKEDITOR.replace('body-{{ $lang->lang }}', {
                                                language: '{{$lang}}',
                                                height: '200px'
                                            });
                                        </script>
                                        @endif
                                        @endforeach --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Seo Title[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_title_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_title }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                    <div class="col-md-4">
                                        <label>Seo Description[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_description_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_description }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                    <div class="col-md-4">
                                        <label>Seo Keywords[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_keywords_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_keywords }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                    <div class="col-md-12">
                                        <label>Seo Text[{{ $lang->lang }}]</label>
                                        <textarea name="seo_text_{{ $lang->lang }}" height="300" class="form-control">@foreach($category->translations as $translation)@if($translation->lang_id == $lang->id){{ $translation->seo_text }}@endif @endforeach</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Image:</h5><hr>
                    <div class="form-group">
                        <label for="img">Select banner</label>
                        <input type="file" name="banner" id="banner"/><br>
                        @if ($category->banner)
                            <input type="hidden" name="old_banner" value="{{ $category->banner }}"/>
                            <img src="{{ asset('/images/blogCategories/og/'. $category->banner ) }}" style="height:100px;">
                            <a href="{{ url('/back/blog-categories/'. $category->id .'/delete-bannner') }}"><small>Delete</small></a>
                        @else
                            <img src="{{ asset('admin/img/noimage.jpg') }}" style="height:100px;">
                        @endif
                    </div> <hr>
                </div>



                <div class="col-md-12" id="anchors"> <hr>
                    <h5 class="text-center">Anchors:</h5>
                    <hr>
                    @if ($category->blogs)
                        @foreach ($category->blogs as $key => $blog)
                            {{-- <span class="del-btn">
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit" class="btn-link">
                                        <a href=""><i class="fa fa-trash"></i></a>
                                    </button>
                                </form>
                            </span> --}}
                            <div class="exist-block">
                                @foreach($blog->translations as $translation)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Title[{{ $langs->find($translation->lang_id)->lang }}]</label>
                                            <input type="text" name="title_old[{{ $blog->id }}][{{ $translation->lang_id }}]" value="{{ $translation->name }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Content[{{ $lang->lang }}]</label>
                                            <textarea id="body-{{ uniqid() }}" name="content_old[{{ $blog->id }}][{{ $translation->lang_id }}]" rows="8" cols="80" class="form-control editor">
                                                {{ $translation->body }}
                                            </textarea>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach
                    @endif

                    <div class="to-clone">
                        @foreach ($langs as $key => $lang)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Title[{{ $lang->lang }}]</label>
                                    <input type="text" name="title[{{ $lang->id }}][]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Content[{{ $lang->lang }}]</label>
                                    <textarea id="body-{{ uniqid() }}" name="content[{{ $lang->id }}][]" rows="8" cols="80" class="form-control editor"></textarea>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-12 text-center">
                    <span class="fa fa-plus add-new"></span>
                </div>

            </div>
            <div class="row text-center">
                <div class="col-md-12"> <br><hr>
                    <input type="submit" class="btn btn-primary" value="Save" class="submit">
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

<script>
$(function(){
    $('.editor').each(function(e){
        CKEDITOR.replace( this.id, {
            language: '{{$lang}}',
            height: '200px'
        });
    });
});
    // $(document).ready(function(){
    //     $('.add-new').on('click', function(){
    //
    //         var target  = $(this).parent().prev();
    //         var child = $(this).parents().prev().find('.to-clone');
    //         child.appendTo(target);
    //
    //
    //         console.log(target, child);
    //
    //     })
    // })
</script>
<style media="screen">
.exist-block{
    position: relative;
}
.del-btn{
    margin-top: -96px;
    display: inline-block;
    margin-left: 97%;
}
</style>
@stop
