@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="projects-all-content">
       <div class="home-content">
           @include('front.partials.search')
       </div>
       <div class="container">
         <div class="row">

             @if ($children->count() > 0)
                 @foreach ($children as $key => $child)
                     <div class="col-lg-4 col-md-6">
                       <div class="item-project-one">
                         <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}" class="image-container">
                             @if ($child->banner_desktop)
                                 <img src="/images/categories/og/{{ $child->banner_desktop }}" alt="" />
                             @else
                                 <img src="/cover.png" alt="">
                             @endif
                         </a>
                         {{-- <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}"> --}}
                             <a class="title" href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                 {{ $child->translation->name }}
                             </a>
                         {{-- </a> --}}
                       </div>
                     </div>
                 @endforeach
             @endif

         </div>
       </div>
     </main>

@include('front.partials.footer')
@stop
