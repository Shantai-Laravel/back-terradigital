@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="contact-content">
    <section>
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
                <div class="col-md-6">
                    <p>{!! $page->translation->body !!}</p>
                </div>
                <div class="col-lg-4 col-md-6 posrelative">
                    <form action="{{ url('/'.$lang->lang.'/proposes-book') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>{{ trans('vars.Contacts.achizitieFormTitle') }}</p>
                        <textarea cols="30" rows="20" required name="message" placeholder="{{ trans('vars.Contacts.achizitieLabelTitlulCartii') }}"></textarea>
                        <input type="text" name="name" required placeholder="{{ trans('vars.Contacts.contactsFormNameLabel') }}" />
                        <input type="email" name="email" required placeholder="{{ trans('vars.Contacts.contactsLabelEmailLabel') }}" />
                        <input type="submit" value="{{ trans('vars.Contacts.contactsFormButtonText') }}" />
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop
