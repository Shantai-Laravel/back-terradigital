@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="home-content questions-content">

    @include('front.partials.search')

    <section class="questions">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $page->translation->title }}</h3>
                    @if (Session::has('message'))
                    <p class="text-center alert alert-success">
                        {{ Session::get('message') }}
                    </p>
                    @endif
                </div>
                <div class="col-12">
                    <p>
                        {!! $page->translation->body !!}
                    </p>
                </div>
                <div class="col-12 form-question">
                    <div class="row">
                        <div class="col-md-auto">
                            <button class="button" id="toggleForm">
                            <span>{{ trans('vars.Contacts.faqButonTrimiteIntrebarea') }}</span>
                            </button>
                        </div>
                        <div class="col-12">
                            <form id="formQuestions" action="{{ url('/'.$lang->lang.'/contact-feed-back') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{ trans('vars.Contacts.faqIntrebareTitleSiLabel') }}:</p>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="name" required placeholder="{{ trans('vars.Contacts.contactsFormNameLabel') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="email" name="email" required placeholder="{{ trans('vars.Contacts.contactsLabelEmailLabel') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="phone" placeholder="{{ trans('vars.Contacts.contactsFormPhoneLabel') }}" />
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" required id="" cols="30" rows="10" placeholder="{{ trans('vars.Contacts.faqIntrebareTitleSiLabel') }}"></textarea>
                                    </div>
                                    <div class="col-md-auto">
                                        <button class="button" type="submit">
                                            <span>{{ trans('vars.Contacts.faqButonTrimiteIntrebarea') }}</span>
                                            <svg
                                                width="43px"
                                                height="42px"
                                                viewBox="0 0 43 42"
                                                version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                >
                                                <g id="Site" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g
                                                        id="Intrebari_Hasdeu---Intreaba"
                                                        transform="translate(-1553.090946, -1184.000000)"
                                                        fill="#FFFFFF"
                                                        >
                                                        <g id="intreaba" transform="translate(265.000000, 791.000000)">
                                                            <g id="Button" transform="translate(1136.000000, 380.601071)">
                                                                <g id="dove" transform="translate(152.244629, 12.370394)">
                                                                    <path
                                                                        d="M42.4069821,11.0021163 L31.7783058,0.373439978 C31.2998985,-0.104967364 30.4579884,-0.0774938058 30.0070546,0.373439978 L22.9220498,7.45844478 C22.4327866,7.94770794 22.4327866,8.74043283 22.9220498,9.22969598 L26.1655998,12.473246 C24.0760228,12.7906533 22.0451506,14.2185267 21.3618189,16.4785401 C20.8015754,18.3280366 19.3973342,20.1592453 18.9031442,20.2131068 C14.8223605,17.1329786 9.62359499,16.4601687 5.33613328,18.4577218 C3.31653447,19.4008415 1.4763071,20.9017829 0.210185247,22.8002142 C-0.112733446,23.284634 -0.0589554169,23.9280497 0.339870463,24.3537646 C0.738696342,24.7781434 1.37843777,24.8711693 1.88239803,24.5775613 C4.21355868,23.2222548 7.51898682,25.8318253 8.66703083,28.2961784 C10.1545278,31.4839462 13.6749845,33.0912747 16.971561,32.2851888 C17.2933106,34.7861176 15.2069068,37.2634142 12.6413441,38.3194344 C11.5532576,38.7671114 11.6336741,40.342958 12.7612591,40.6790706 C15.923975,41.618516 19.3931589,41.3274132 22.2725381,39.9842986 C27.1520592,37.7090871 30.1575329,32.7623435 29.9299783,27.3825365 C29.8245099,24.8771818 27.6440781,19.6491056 29.0663566,18.9849803 L31.5292066,17.8368528 L33.5507261,19.8583723 C34.0399892,20.3476354 34.8327141,20.3476354 35.3219773,19.8583723 L42.4069821,12.7733675 C42.8860575,12.2942921 42.8566633,11.4517975 42.4069821,11.0021163 Z M34.4363934,17.2014537 L25.5788848,8.34402863 L30.1236293,3.79920063 L31.4369322,10.3611222 C31.5360542,10.8565649 31.9237737,11.2442844 32.4192163,11.3434063 L38.9811379,12.6567092 L34.4363934,17.2014537 Z"
                                                                        id="Shape"
                                                                        fill-rule="nonzero"
                                                                        ></path>
                                                                    <path
                                                                        d="M13.2688936,12.2901168 C10.2548188,11.0472932 7.06588187,11.0766874 4.28303588,12.373289 C3.93322817,12.5359592 3.67878461,12.8516128 3.5919381,13.2271405 C3.5050916,13.6026681 3.59686497,13.9978197 3.84028571,14.2974402 L5.10348485,15.8557504 C6.81953841,15.1801848 8.63404586,14.8173501 10.5239594,14.8173501 C13.2493531,14.8173501 15.996709,15.5586351 18.4542146,16.9347347 C18.5408941,16.7774089 18.600267,16.5873487 18.6788464,16.4138227 C17.2218292,14.5947224 15.3742533,13.1590829 13.2688936,12.2901168 Z"
                                                                        id="Path"
                                                                        ></path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @foreach ($faq as $key => $item)
                    <div class="question-one">
                        <div class="header">
                            <div class="row align-items-center">
                                <div class="col-md-auto d-flex">
                                    <div class="date">
                                        {{ $item->created_at->format('d-m-Y')  }}
                                    </div>
                                </div>
                                <div class="col-md-auto">
                                    <div class="title">
                                        {{ $item->subject }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text">
                                        <span>Î</span>
                                        <p>
                                            {{ $item->message }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="response">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text">
                                        <span>R</span>
                                        <p>
                                            {{ $item->additional_1 }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop
