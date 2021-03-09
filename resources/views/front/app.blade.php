<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="nofollow,noindex" />
        <meta name="googlebot" content="noindex, nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ @$seoData['title'] }}</title>
        <meta name="description" content="{{ @$seoData['description'] }}">
        <meta name="keywords" content="{{ @$seoData['keywords'] }}">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="/fronts/img/favicon.png" type="image/x-icon">
        <link rel="icon" href="https://front.soledy.com/mountain_4/img/icons/favicon.svg" />
        <link rel="stylesheet"
              type="text/css"
              href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
              />
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"
            />
        <link rel="stylesheet" type="text/css" href="{{ asset('fronts/css/style.bundle4.css?'.uniqid()) }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
        {{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37788049-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-37788049-1');
        </script>
    </head>

    <div id="cover-mob">
        @yield('content')
        {{-- @include('front.partials.modals') --}}
    </div>

    <body>
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
            ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"
            ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"
            ></script>

        <script src="/{{ $lang->lang }}/js/lang.js?{{ uniqid('', true) }}"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://unpkg.com/split.js/dist/split.min.js"></script>
        <script src="{{ asset('fronts_mobile/js/app_mobile.js?'.uniqid()) }}"></script>
        <script src="{{ asset('fronts/js/bundle.js?'.uniqid()) }}"></script>

        <script>
            $('.view-more').on('click', function(){
                $(this).next('.body').show();
                $(this).prev('.description').hide();
                $(this).hide();
            });

            $('.advaced-search').on('keyup', function(){
                let urlStart = 'https://opac.hasdeu.md/cgi-bin/koha/opac-search.pl?advsearch=1&idx=kw&q=';
                let urlEnd = '&idx=kw&idx=kw&do=Search&sort_by=relevance';
                let value = $(this).val();
                let href = urlStart+value+urlEnd;
                $('.redirect-link').attr('href', href);
            });
        </script>
    </body>
</html>
