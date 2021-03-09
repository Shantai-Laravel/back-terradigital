@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.category' , ['category' => Request::get('category')]) }}">Books</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Book</li>
    </ol>
</nav>
<div class="title-block">
    <h3 class="title"> Create Book
        @if (!is_null($category))
            @if (!is_null($category->translation->first()))
                [ {{ $category->translation->first()->name }} ]
            @endif
        @endif
    </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
    trans('variables.add_element') => route('products.create', ['category' => Request::get('category')])
    ]
    ])
</div>

@include('admin::admin.alerts')

<div class="list-content">
    <form class="form-reg" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <label>Categorie</label>
                            <select name="category_id">
                            @foreach($categories as $categoryOne)
                            <option value="{{ $categoryOne->id }}" {{ Request::get('category') == $categoryOne->id ? 'selected' : '' }}>{{ $categoryOne->translation($lang->id)->first()->name }}</option>
                            @endforeach
                            </select>
                            @if (Request::get('category'))
                                <a class="btn btn-primary btn-sm" href="{{ url('/back/products/category/'.Request::get('category')) }}"><< Back to category</a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
        </div>
        {{ csrf_field() }}
        @if (!empty($langs))
        @foreach ($langs as $lang)
        <div class="tab-content {{ $loop->first ? ' active-content' : '' }}" id={{ $lang->
            lang }}>
            <div class="part full-part">
                <ul>
                    <li>
                        <label>{{trans('variables.title_table')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="name_{{ $lang->lang }}" class="name"
                            data-lang="{{ $lang->lang }}">
                    </li>
                    <li class="ckeditor">
                        <label>{{trans('variables.description')}} [{{ $lang->lang }}]</label>
                        <textarea name="description_{{ $lang->lang }}"></textarea>
                        <script>
                            CKEDITOR.replace('description_{{ $lang->lang }}', {
                                language: '{{$lang}}',
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
                        <input type="text" name="meta_title_{{ $lang->lang }}">
                    </li>
                    <li>
                        <label>{{trans('variables.meta_keywords_page')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="meta_keywords_{{ $lang->lang }}">
                    </li>
                    <li>
                        <label>{{trans('variables.meta_description_page')}} [{{ $lang->lang }}]</label>
                        <input type="text" name="meta_description_{{ $lang->lang }}">
                    </li>
                    <hr>

                </ul>
            </div> --}}
        </div>

        @endforeach
        @endif
        <div class="part full-part">
            <ul>
                <li>
                    <input type="submit" class="btn btn-primary" value="Save">
                </li>
            </ul>
        </div>

    </form>
</div>
@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
