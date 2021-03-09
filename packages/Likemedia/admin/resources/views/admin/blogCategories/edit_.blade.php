@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('blog-categories.index') }}">Blog Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Edit Category </h3>
</div>

<div class="card">
    <div class="card-block">

        <div class="row">
            <form class="form-reg" method="post" action="{{ route('blog-categories.update', $category->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('PATCH') }}

                @if ($category->type == "link")
                    <div class="col-md-12">
                        @foreach ($langs as $key => $lang)
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Link [{{ $lang->lang }}]</label>
                                    <input type="text" name="link_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                                value="{{ $translation->link }}"
                                            @endif
                                        @endforeach
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif($category->type == "accordion")
                    <div class="row">
                        @foreach ($langs as $key => $lang)
                            <div class="col-md-4">
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
                        @endforeach
                        @foreach ($langs as $key => $lang)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Text [{{ $lang->lang }}]</label>
                                    @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                            <textarea name="description_{{ $lang->lang }}" class="form-control" rows="8" cols="80">
                                                {{ $translation->description }}
                                            </textarea>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @if ($category->parent_id == 0)
                            @foreach ($langs as $key => $lang)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Seo Title[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_title_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_title }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($langs as $key => $lang)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Seo Description[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_description_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_description }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($langs as $key => $lang)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Seo Keywords[{{ $lang->lang }}]</label>
                                        <input type="text" name="seo_keywords_{{ $lang->lang }}" class="form-control"
                                        @foreach($category->translations as $translation)
                                        @if ($translation->lang_id == $lang->id)
                                        value="{{ $translation->seo_keywords }}"
                                        @endif
                                        @endforeach
                                        >
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-md-4 text-center">
                            <label for="">Images Left</label>
                            <input type="file" name="image_left" value="">
                            @if ($category->image_left)
                                <input type="hidden" name="image_left_old" value="{{ $category->image_left }}">
                                <img src="/images/blogCategories/og/{{ $category->image_left }}" height="200px;">
                                <a href="{{ url('/back/blog-categories/removeImage/image_left/'.$category->id) }}">Remove</a>
                            @endif
                        </div>
                        <div class="col-md-4 text-center">
                            <label for="">Images Right</label>
                            <input type="file" name="image_right" value="">
                            @if ($category->image_right)
                                <input type="hidden" name="image_right_old" value="{{ $category->image_right }}">
                                <img src="/images/blogCategories/og/{{ $category->image_right }}" height="200px;">
                                <a href="{{ url('/back/blog-categories/removeImage/image_right/'.$category->id) }}">Remove</a>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="">Link</label>
                            <input type="text" name="main_link" value="{{ $category->link }}" class="form-control">
                        </div>

                    </div>

                    @if ($category->parent_id > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <hr><h5 class="text-center">List:</h5>
                            </div>
                        </div>

                        @foreach ($accordions as $key => $accordion)
                            <div class="row show">
                                <div class="col-md-12"><hr></div>
                                <input type="hidden" name="edited_item[]" value="{{ $accordion->id }}">
                                <div class="col-md-1 text-center"> <br> <br>
                                    <h6 class="label label-success">ID {{ $accordion->id }}</h6>
                                    <label class="text-center">
                                        <input type="checkbox" name="removeItems[{{ $accordion->id }}]" class="checkbox">
                                        <span>Delete</span>
                                    </label>
                                </div>
                                <div class="col-md-11">
                                    @foreach ($langs as $key => $lang)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Item Title [{{ $lang->lang }}]</label>
                                                <input type="text" name="edited_title_{{ $lang->lang }}[{{ $accordion->id }}]" class="form-control"
                                                    @foreach($accordion->translations as $translation)
                                                        @if ($translation->lang_id == $lang->id)
                                                            value="{{ $translation->title }}"
                                                        @endif
                                                    @endforeach
                                                >
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach ($langs as $key => $lang)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Item Link [{{ $lang->lang }}]</label>
                                                <input type="text" name="edited_link_{{ $lang->lang }}[{{ $accordion->id }}]" class="form-control"
                                                    @foreach($accordion->translations as $translation)
                                                        @if ($translation->lang_id == $lang->id)
                                                            value="{{ $translation->link }}"
                                                        @endif
                                                    @endforeach
                                                >
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @for ($i=0; $i < 15; $i++)
                        <div class="row block_{{$i}} {{ $i == 0 ? 'show' : 'hide' }}">
                            <div class="col-md-12"><hr></div>
                            <input type="hidden" name="created_item[]" value="{{ $i }}">
                            <div class="col-md-1"></div>
                            <div class="col-md-11">
                                @foreach ($langs as $key => $lang)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Title [{{ $lang->lang }}]</label>
                                            <input type="text" name="title_{{ $lang->lang }}[]" class="form-control"
                                                @foreach($category->translations as $translation)
                                                    @if ($translation->lang_id == $lang->id)
                                                        value=""
                                                    @endif
                                                @endforeach
                                            >
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($langs as $key => $lang)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Link [{{ $lang->lang }}]</label>
                                            <input type="text" name="link_{{ $lang->lang }}[]" class="form-control"
                                                @foreach($category->translations as $translation)
                                                    @if ($translation->lang_id == $lang->id)
                                                        value=""
                                                    @endif
                                                @endforeach
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12 text-center">
                                <i class="fa fa-plus add-button" data="block_{{$i + 1}}"></i>
                            </div>
                        </div>
                        @endfor
                    @endif




                    {{-- <div class="col-md-8">
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
                            <div class="tab-content {{ $key == 0 ? ' active-content' : '' }}" id={{ $lang->
                                lang }}>
                                <div class="part full-part">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{trans('variables.title_table')}}[{{ $lang->lang }}]</label>
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
                                            @foreach($category->translations as $translation)
                                                @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                                <div class="form-group">
                                                    <label for="descr-{{ $lang->lang }}">Description [{{ $lang->lang }}]</label>
                                                    <textarea name="description_{{ $lang->lang }}" id="body-{{ $lang->lang }}" class="form-control">{{ $translation->description }}</textarea>
                                                </div>
                                                <script>
                                                    CKEDITOR.replace('body-{{ $lang->lang }}', {
                                                        language: '{{$lang}}',
                                                        height: '200px'
                                                    });
                                                </script>
                                                @endif
                                            @endforeach
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
                                    <div class="row">
                                        <hr>
                                            <h6 class="text-center">Images</h6>
                                        <hr>
                                        <div class="col-md-6">
                                            <li>
                                                @foreach($category->translations as $translation)
                                                @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                                    @if ($translation->banner_desktop)
                                                    <img src="{{ asset('images/blogCategories/og/'. $translation->banner_desktop ) }}" style="height:100px;"><br>
                                                    <input type="hidden" name="old_banner_desktop_{{ $lang->lang }}" value="{{ $translation->banner_desktop }}"/>
                                                    @else
                                                        <img src="{{ asset('admin/img/noimage.jpg') }}" style="height:100px;">
                                                    @endif
                                                @endif
                                                @endforeach

                                                <label for="img-{{ $lang->lang }}">Banner desktop [{{ $lang->lang }}]</label><br>
                                                <input type="file" name="banner_desktop_{{ $lang->lang }}" id="img-{{ $lang->lang }}"/>
                                            </li>
                                        </div>
                                        <div class="col-md-6">
                                            <li>
                                                @foreach($category->translations as $translation)
                                                @if($translation->lang_id == $lang->id && !is_null($translation->lang_id))
                                                    @if ($translation->banner_mobile)
                                                    <img src="{{ asset('images/blogCategories/og/'. $translation->banner_mobile ) }}" style="height:100px;"><br>
                                                    <input type="hidden" name="old_banner_mobile_{{ $lang->lang }}" value="{{ $translation->banner_mobile }}"/>
                                                    @else
                                                        <img src="{{ asset('admin/img/noimage.jpg') }}" style="height:100px;">
                                                    @endif
                                                @endif
                                                @endforeach

                                                <label for="img-{{ $lang->lang }}">Banner mobile [{{ $lang->lang }}]</label><br>
                                                <input type="file" name="banner_mobile_{{ $lang->lang }}" id="img-{{ $lang->lang }}"/>
                                            </li>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="alias">Alias</label>
                                <input id="alias" type="text" name="alias" class="form-control" value="{{ $category->alias }}">
                            </div>

                            <div class="form-group">
                                <label>
                                    <input class="checkbox" type="checkbox" name="active" {{ $category->active == 1 ? 'checked' : ''}}>
                                    <span>Active</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="img">select an icon</label>
                                <input type="file" name="icon" id="img"/><br>
                                @if ($category->icon)
                                    <input type="hidden" name="old_icon" value="{{ $category->icon }}"/>
                                    <img src="{{ asset('/images/blogCategories/og/'. $category->icon ) }}" style="height:70px;">
                                @else
                                    <img src="{{ asset('admin/img/noimage.jpg') }}" style="height:70px;">
                                @endif
                            </div>

                        </div> --}}
                    @else
                        <div class="row">
                            @foreach ($langs as $key => $lang)
                                <div class="col-md-4">
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
                            @endforeach
                            @foreach ($langs as $key => $lang)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Text [{{ $lang->lang }}]</label>
                                        @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                                <textarea name="description_{{ $lang->lang }}" id="body-{{ $lang->lang }}"  class="form-control" rows="8" cols="80">
                                                    {{ $translation->description }}
                                                </textarea>
                                                <script>
                                                    CKEDITOR.replace('body-{{ $lang->lang }}', {
                                                        language: '{{$lang}}',
                                                        height: '200px'
                                                    });
                                                </script>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            @if ($category->parent_id == 0)
                                @foreach ($langs as $key => $lang)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seo Title[{{ $lang->lang }}]</label>
                                            <input type="text" name="seo_title_{{ $lang->lang }}" class="form-control"
                                            @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                            value="{{ $translation->seo_title }}"
                                            @endif
                                            @endforeach
                                            >
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seo Description[{{ $lang->lang }}]</label>
                                            <input type="text" name="seo_description_{{ $lang->lang }}" class="form-control"
                                            @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                            value="{{ $translation->seo_description }}"
                                            @endif
                                            @endforeach
                                            >
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($langs as $key => $lang)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Seo Keywords[{{ $lang->lang }}]</label>
                                            <input type="text" name="seo_keywords_{{ $lang->lang }}" class="form-control"
                                            @foreach($category->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                            value="{{ $translation->seo_keywords }}"
                                            @endif
                                            @endforeach
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif

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
    $(document).ready(function(){
        $('.add-button').on('click', function(){
            let blockClass = $(this).attr('data');
            $('.' + blockClass).removeClass('hide');
            $('.' + blockClass).addClass('show');
            $(this).hide();

        })
    })
</script>
@stop
