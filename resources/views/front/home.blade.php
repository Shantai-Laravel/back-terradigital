@extends('../front.app')
@section('content')
@include('front.partials.header')
@php
    $slider1 = GetGallery('Evenimente. Programe. Servicii', $lang->id);
    $slider2 = GetGallery('Blogurile noastre', $lang->id);
    $slider3 = GetGallery('Profesional', $lang->id);
    $slider4 = GetGallery('Parteneriate', $lang->id);

    $slider5 = GetGallery('Recomandări', $lang->id);
    $slider6 = GetGallery('Cultura Minorităților', $lang->id);
    $slider7 = GetGallery('Prioritățile anului', $lang->id);

@endphp
<main class="home-content">

    <section class="slider-section blog-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionEvenimenteTitle') }}</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if (!is_null($slider1->first()))
                            <a href="{{ $slider1->first()->link }}" target="_blank" class="col-md-4 blog-item static-item event-item">
                                <div class="image-container">
                                  <img src="{{ $slider1->first()->src }}" alt="" />
                                </div>
                                <div class="blog-description">
                                    <div>
                                        <p class="blog-title">{{ $slider1->first()->title }}</p>
                                        <p>{{ $slider1->first()->text }}</p>
                                    </div>
                                </div>
                            </a>
                        @endif

                        <div class="col-md-8">
                            <div class="slider-standard slider-events">

                                @foreach ($slider1 as $key => $image)
                                    @if ($key !== 0)
                                        <a target="_blank" href="{{ $image->link }}" class="blog-item">
                                            <div class="image-container">
                                              <img src="{{ $image->src }}" alt="" />
                                            </div>
                                            <div class="blog-description">
                                                <div>
                                                    <p class="blog-title">{{ $image->title }}</p>
                                                    <p>{{ $image->text }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-auto">
                    <a href="http://evenimente.hasdeu.md/" class="button"><span>{{ trans('vars.General.hpButonVeziToate') }}</span></a>
                </div>
            </div>
        </div>
    </section>

    @include('front.partials.search')

    @php
        $setting = getSettings();
    @endphp

    @if ($setting['promotions'] == 'active')
    <section class="text-sub">
        <div class="container">
            <p>
                {{ trans('vars.General.hpNotificareAlarm') }}
            </p>
        </div>
    </section>
    @endif

    @if ($categories->count() > 0)
    @foreach ($categories as $key => $category)
    @php
        $key = $key + 1;
    @endphp
    @if (($key % 2 == 1) && ($key % 3 != 0))
    <section class="slider-section section-gray image-zagl">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3>{{ $category->translation->name }}</h3>
                    <div class="slider-standard slider-fixed-width">
                        @if ($category->products->count() > 0)
                        @foreach ($category->products as $key => $product)
                        <div class="item-slider-standard book-item">
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="image-container">
                                <img src="{{ $product->image }}" alt="" />
                            </a>
                            <div class="">
                                <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="product-name">{{ $product->translation->name }}</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-auto">
                    <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias) }}" class="button"><span>{{ trans('vars.General.hpButonVeziToate') }}</span></a>
                </div>
            </div>
        </div>
    </section>
    @elseif ($key % 2 == 0)
    <section class="slider-section image-zagl">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h3>{{ $category->translation->name }}</h3>
                    <div class="slider-standard slider-fixed-width">
                        @if ($category->products->count() > 0)
                        @foreach ($category->products as $key => $product)
                        <div class="item-slider-standard book-item electron-book">
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="image-container">
                                <div class="icon"></div>
                                <img src="{{ $product->image }}" alt="" />
                            </a>
                            <div class="">
                                <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="product-name">{{ $product->translation->name }}</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-auto">
                    <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias) }}" class="button"><span>{{ trans('vars.General.hpButonVeziToate') }}</span></a>
                </div>
            </div>
        </div>
    </section>
    @elseif ($key % 3 == 0)
    <section class="slider-section film-section image-zagl">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $category->translation->name }}</h3>
                </div>
            </div>
        </div>
        <div class="slider-standard slider-standard-film">
            @if ($category->products->count() > 0)
            @foreach ($category->products as $key => $product)
            <div class="item-slider-standard book-item film-item">
                <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias.'/'.$product->alias) }}" class="image-container">
                    <img src="{{ $product->image }}" alt="" />
                    <div class="description">
                        <p class="product-name">{{ $product->translation->name }}</p>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto">
                    <a href="{{ url('/'.$lang->lang.'/catalog/'.$category->alias) }}" class="button"><span>{{ trans('vars.General.hpButonVeziToate') }}</span></a>
                </div>
            </div>
        </div>
    </section>
    @endif
    @endforeach
    @endif


    <section class="slider-section blog-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionRecomandăriTitle') }}</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if (!is_null($slider5->first()))
                            <a target="_blank" href="{{ $slider5->first()->link }}" class="col-md-4 blog-item static-item event-item">
                                <div class="image-container">
                                    @if ($slider5->first()->type == 'image')
                                        <img src="{{ $slider5->first()->src }}" alt="" />
                                    @elseif($slider5->first()->type == 'video')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="" />
                                          <video src="/images/galleries/videos/{{ $slider5->first()->src }}"
                                              poster="/fronts/img/icons/logo-svg.svg"
                                              width="100%"
                                              height="100%"
                                              autostart="false"
                                              controls>
                                          </video>
                                        </div>
                                    @elseif($slider5->first()->type == 'iframe')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="" />
                                          <iframe width="100%"
                                                  height="100%"
                                                  src="{{ $slider5->first()->src }}"
                                                  frameborder="0"
                                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                  allowfullscreen>
                                          </iframe>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-description">
                                    <div>
                                        <p class="blog-title">{{ $slider5->first()->title }}</p>
                                        <p>{{ $slider5->first()->text }}</p>
                                    </div>
                                </div>
                            </a>
                        @endif

                        <div class="col-md-8">
                            <div class="slider-standard slider-events">
                                @foreach ($slider5 as $key => $image)
                                    @if ($key !== 0)
                                        <a target="_blank" href="{{ $image->link }}" class="blog-item">
                                            <div class="image-container">
                                                @if ($image->type == 'image')
                                                    <img src="{{ $image->src }}" alt="" />
                                                @elseif($image->type == 'video')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <video src="/images/galleries/videos/{{ $image->src }}"
                                                          poster="/fronts/img/icons/logo-svg.svg"
                                                          width="100%"
                                                          height="100%"
                                                          autostart="false"
                                                          controls>
                                                      </video>
                                                    </div>
                                                @elseif($image->type == 'iframe')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <iframe width="100%"
                                                              height="100%"
                                                              src="{{ $image->src }}"
                                                              frameborder="0"
                                                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                              allowfullscreen>
                                                      </iframe>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="blog-description">
                                                <div>
                                                    <p class="blog-title">{{ $image->title }}</p>
                                                    <p>{{ $image->text }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section blog-section section-gray title-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionBloguriTitle') }} </h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if (!is_null($slider2->first()))
                            <a target="_blank" href="{{ $slider2->first()->link }}" class="col-md-4 blog-item static-item">
                                <div class="image-container">
                                  <img src="{{ $slider2->first()->src }}" alt="" />
                                </div>
                                <div class="blog-description">
                                    <div>
                                        <p class="blog-title">
                                            {{ $slider2->first()->title }}
                                        </p>
                                        <p>
                                            {{ $slider2->first()->text }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endif

                        <div class="col-md-8 slider-standard slider-blog">
                            @foreach ($slider2 as $key => $image)
                                @if ($key !== 0)
                                    <a target="_blank" href="{{ $image->link }}" class="blog-item">
                                        <div class="image-container">
                                            <img src="{{ $image->src }}" alt="" />
                                        </div>
                                        <div class="blog-description">
                                            <div>
                                                <p class="blog-title">{{ $image->title }}</p>
                                                <p>{{ $image->text }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section blog-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionCulturaMinorităților') }}</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if (!is_null($slider6->first()))
                            <a target="_blank"  href="{{ $slider6->first()->link }}" class="col-md-4 blog-item static-item event-item">
                                <div class="image-container">
                                    @if ($slider6->first()->type == 'image')
                                        <img src="{{ $slider6->first()->src }}" alt="" />
                                    @elseif($slider6->first()->type == 'video')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="">
                                          <video src="/images/galleries/videos/{{ $slider6->first()->src }}"
                                              poster="/fronts/img/icons/logo-svg.svg"
                                              width="100%"
                                              height="100%"
                                              autostart="false"
                                              controls>
                                          </video>
                                        </div>
                                    @elseif($slider6->first()->type == 'iframe')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="">
                                          <iframe width="100%"
                                                  height="100%"
                                                  src="{{ $slider6->first()->src }}"
                                                  frameborder="0"
                                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                  allowfullscreen>
                                          </iframe>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-description">
                                    <div>
                                        <p class="blog-title">{{ $slider6->first()->title }}</p>
                                        <p>{{ $slider6->first()->text }}</p>
                                    </div>
                                </div>
                            </a>
                        @endif

                        <div class="col-md-8">
                            <div class="slider-standard slider-events">
                                @foreach ($slider6 as $key => $image)
                                    @if ($key !== 0)
                                        <a target="_blank" href="{{ $image->link }}" class="blog-item">
                                            <div class="image-container">
                                                @if ($image->type == 'image')
                                                    <img src="{{ $image->src }}" alt="" />
                                                @elseif($image->type == 'video')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <video src="/images/galleries/videos/{{ $image->src }}"
                                                          poster="/fronts/img/icons/logo-svg.svg"
                                                          width="100%"
                                                          autostart="false"
                                                          controls>
                                                      </video>
                                                    </div>
                                                @elseif($image->type == 'iframe')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <iframe width="100%"
                                                              height="100%"
                                                              src="{{ $image->src }}"
                                                              frameborder="0"
                                                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                              allowfullscreen>
                                                      </iframe>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="blog-description">
                                                <div>
                                                    <p class="blog-title">{{ $image->title }}</p>
                                                    <p>{{ $image->text }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section blog-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionPrioritățileAnului') }}</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @if (!is_null($slider7->first()))
                            <a target="_blank"  href="{{ $slider7->first()->link }}" class="col-md-4 blog-item static-item event-item">
                                <div class="image-container">
                                    @if ($slider7->first()->type == 'image')
                                        <img src="{{ $slider7->first()->src }}" alt="" />
                                    @elseif($slider7->first()->type == 'video')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="">
                                          <video src="/images/galleries/videos/{{ $slider7->first()->src }}"
                                              poster="/fronts/img/icons/logo-svg.svg"
                                              width="100%"
                                              autostart="false"
                                              controls>
                                          </video>
                                        </div>
                                    @elseif($slider7->first()->type == 'iframe')
                                        <div class="video-container">
                                          <img src="/images/imageVideo.jpg" alt="">
                                          <iframe width="100%"
                                                  height="100%"
                                                  src="{{ $slider7->first()->src }}"
                                                  frameborder="0"
                                                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                  allowfullscreen>
                                          </iframe>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-description">
                                    <div>
                                        <p class="blog-title">{{ $slider7->first()->title }}</p>
                                        <p>{{ $slider7->first()->text }} </p>
                                    </div>
                                </div>
                            </a>
                        @endif

                        <div class="col-md-8">
                            <div class="slider-standard slider-events">
                                @foreach ($slider7 as $key => $image)
                                    @if ($key !== 0)
                                        <a target="_blank"  href="{{ $image->link }}" class="blog-item">
                                            <div class="image-container">
                                                @if ($image->type == 'image')
                                                    <img src="{{ $image->src }}" alt="" />
                                                @elseif($image->type == 'video')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <video src="/images/galleries/videos/{{ $image->src }}"
                                                          poster="/fronts/img/icons/logo-svg.svg"
                                                          width="100%"
                                                          autostart="false"
                                                          controls>
                                                      </video>
                                                    </div>
                                                @elseif($image->type == 'iframe')
                                                    <div class="video-container">
                                                      <img src="/images/imageVideo.jpg" alt="">
                                                      <iframe width="100%"
                                                              height="100%"
                                                              src="{{ $image->src }}"
                                                              frameborder="0"
                                                              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                              allowfullscreen>
                                                      </iframe>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="blog-description">
                                                <div>
                                                    <p class="blog-title">{{ $image->title }}</p>
                                                    <p>{{ $image->text }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        @php
            $banner = Banner('hp-banner-card-inteligent-en', 'desktop');
        @endphp
        @if ($banner)
            <a href="{{ $banner['link'] }}" target="_blank">
                <img src="{{ $banner['src'] }}" alt="">
            </a>
        @endif
    </section>
    <section class="slider-section blog-section section-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionProfesionalTitle') }}</h3>
                </div>
                <div class="col-12">
                    <div class="slider-standard slider-professional">

                        @foreach ($slider3 as $key => $image)
                        <a target="_blank"  href="http://ojs.hasdeu.md/index.php/bibliopolis" class="blog-item">
                            <div class="image-container">
                              <img src="{{ $image->src }}" alt="" />
                            </div>
                            <div class="blog-description">
                                <div>
                                    <p class="blog-title">
                                        {{ $image->title }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slider-section blog-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-auto col-12">
                    <h3>{{ trans('vars.General.hpSectionParteneriateTitle') }}</h3>
                </div>
                <div class="col-12">
                    <div class="slider-standard slider-professional">

                        @foreach ($slider4 as $key => $image)
                        <a target="_blank" href="{{ $image->link }}" class="blog-item">
                            <div class="image-container">
                              <img src="{{ $image->src }}" alt="" />
                            </div>
                            <div class="blog-description">
                                <div>
                                    <p class="blog-title">
                                        {{ $image->title }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop
