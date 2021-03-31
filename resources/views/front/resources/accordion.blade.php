@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="projects-all-content book-category-one-content new-accordion">
    <div class="home-content">
        {{-- @include('front.partials.search') --}}
        @if ($resource->image_left)
            <img src="/images/blogCategories/og/{{ $resource->image_left }}" alt="">
        @endif
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-md-3 col-12">

                        <ul class="nav nav-static nav-pills" role="tablist">
                          <h3>{{ $resource->translation->name }}</h3>
                            @if ($resource->children()->count() > 0)
                                @foreach ($resource->children as $key => $child)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="pill" href="#menu{{ $child->id }}">
                                        {{ $child->translation->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-9 tab-content category-one-item">
                      @if ($resource->children()->count() > 0)
                          @foreach ($resource->children as $key => $child)
                          <div id="menu{{ $child->id }}" class="tab-section tab-pane fade {{ $key == 0 ? 'active in show' : '' }} ">

                              <div class="card card-body">
                                <div class="row">
                                  <div class="col-md-8 col-12">
                                    @if ($child->translation->description)
                                        <p>{{ $child->translation->description }} </p>
                                    @endif
                                    <ul>
                                        @foreach ($child->accordions as $key => $accordion)
                                        <li>
                                            <a href="{{ $accordion->translation->link }}" target="_blank">
                                            {{ $accordion->translation->title }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                  </div>
                                  <div class="col-md-4 col-12">
                                        <div class="image-static">
                                          @if ($child->image_right)
                                            <div class="image-container">
                                                <a href="{{ $child->link }}" target="_blank">
                                                    <img src="/images/blogCategories/og/{{ $child->image_right }}" alt="">
                                                </a>
                                            </div>
                                          @endif
                                          <div class="sharing_block">
                                              <div class="addthis_toolbox addthis_default_style ">
                                                <a class="addthis_button_preferred_1"></a>
                                                <a class="addthis_button_preferred_2"></a>
                                                <a class="addthis_button_preferred_3"></a>
                                                <a class="addthis_button_preferred_4"></a>
                                                <a class="addthis_button_compact"></a>
                                                <a class="addthis_counter addthis_bubble_style"></a>
                                              </div>
                                              <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507bec157716424a"></script>
                                          </div>
                                        </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          @endforeach
                      @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('front.partials.footer')
@stop
