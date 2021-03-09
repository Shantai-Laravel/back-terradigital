@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        @if (Request::get('set'))
            <li class="breadcrumb-item"><a href="{{ url('/back/products/sets/'.Request::get('set')) }}">Set</a></li>
        @endif
        <li class="breadcrumb-item"><a href="{{ route('products.category' , ['category' => Request::get('category')]) }}">Books</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit book</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Edit book
        @if (!is_null($category))
            @if (!is_null($category->translation))
                [ {{ $category->translation->name }} ]
            @endif
        @endif
    </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
    trans('variables.add_element') => route('products.create', ['category' => Request::get('category')]),
    ]
    ])
</div>

@include('admin::admin.alerts')

<div class="list-content">
    <form class="form-reg" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('PATCH') }}
        <input type="hidden" id="category_id" name="categories_id" value="">

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <label>Category</label>
                            <select name="category_id">
                            @foreach($categories as $categoryItem)
                                <option {{ $categoryItem->id == $product->category_id ? 'selected' : '' }} value="{{ $categoryItem->id }}">{{ $categoryItem->translation->name }}</option>
                            @endforeach
                            </select>

                            @if ($product->category_id > 0)
                                <a class="btn btn-primary btn-sm" href="{{ url('/back/products/category/'.$product->category_id) }}"><< Back to category</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        @if (!empty($langs))
        <div class="tab-area" style="margin-top: 25px;">
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
        </div>
        @foreach ($langs as $lang)
        <div class="tab-content {{ $loop->first ? ' active-content' : '' }}" id={{ $lang->
            lang }}>
            <div class="part full-part">
                <ul style="padding: 25px 0;">
                    <li>
                        <label>{{trans('variables.title_table')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="name_{{ $lang->lang }}" class="name" data-lang="{{ $lang->lang }}"
                        @foreach($product->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->name }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label for="">{{trans('variables.description')}} [{{ $lang->lang }}]</label>
                        <textarea name="description_{{ $lang->lang }}" id="description-{{ $lang->lang }}"
                            data-type="ckeditor">
                                         @foreach($product->translations as $translation)
                                            @if ($translation->lang_id == $lang->id)
                                                {!! $translation->description !!}
                                            @endif
                                        @endforeach
                                    </textarea>
                        <script>
                            CKEDITOR.replace('description-{{ $lang->lang }}', {
                                language: '{{$lang->lang}}',
                            });
                        </script>
                    </li>
                </ul>
            </div>

            {{-- <div class="part right-part">
                <ul>
                    <h6>Seo texts</h6>
                    <li>
                        <label>{{trans('variables.meta_title_page')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="meta_title_{{ $lang->lang }}"
                        @foreach($product->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->seo_title }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label>{{trans('variables.meta_keywords_page')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="meta_keywords_{{ $lang->lang }}"
                        @foreach($product->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->seo_keywords }}"
                        @endif
                        @endforeach
                        >
                    </li>
                    <li>
                        <label>{{trans('variables.meta_description_page')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="meta_description_{{ $lang->lang }}"
                        @foreach($product->translations as $translation)
                        @if ($translation->lang_id == $lang->id)
                        value="{{ $translation->seo_description }}"
                        @endif
                        @endforeach
                        >
                    </li>
                </ul>
            </div> --}}
        </div>
        @endforeach
        @endif

        <div class="part full-part">
            <li>
                <input type="submit" class="btn btn-primary" value="Save">
            </li>
        </div>
    </form>


</div>

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
