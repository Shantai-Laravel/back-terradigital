@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="projects-all-content book-category-one-content">
       <div class="home-content">
         @include('front.partials.search')
       </div>
       <div class="container">
         <div class="row">

           <div class="col-lg-8 col-md-10">
             <h3>{{ $category->translation->name }}</h3>

             @if ($products->count() > 0)
                 @foreach ($products as $key => $product)
                     <div class="item-project-one">
                       <div class="book-description">
                         <div>
                            <span>{{ $product->translation->subject }}</span> <br>
                            <a class="title_" href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}">
                                {{ $product->translation->name }}
                            </a>
                         </div>
                         <p>
                           {{ $product->translation->description }}
                         </p>
                       </div>
                       <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="image-container">
                         <img src="{{ $product->image }}" alt="" />
                       </a>
                     </div>
                 @endforeach
             @endif

           </div>


         </div>
       </div>
     </main>

@include('front.partials.footer')
@stop
