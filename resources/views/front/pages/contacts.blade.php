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
                    <ul>
                        <li>
                            {{ trans('vars.Contacts.pageContactsAddressLabel') }}
                            {{ trans('vars.Contacts.pageContactsAddressName') }}
                        </li>
                        <li>{{ trans('vars.Contacts.pageContactsTelLabel') }}
                            <a href="tel:{{ trans('vars.Contacts.pageContactsTelName') }}"> {{ trans('vars.Contacts.pageContactsTelName') }}</a>
                        </li>
                        <li>
                            {{ trans('vars.Contacts.contactsLabelEmailLabel') }}:
                            <a href="mailto:{{ trans('vars.Contacts.contactsLabelEmailName') }}">{{ trans('vars.Contacts.contactsLabelEmailName') }}</a>
                        </li>
                        <li>
                            {{ trans('vars.Contacts.contactsLabelWebsiteLabel') }}:
                            <a href="{{ trans('vars.Contacts.contactsLabelWebsiteName') }}">{{ trans('vars.Contacts.contactsLabelWebsiteName') }}</a>
                        </li>
                    </ul>
                    <div class="contact-about">
                        <div class="team">

                            @if ($team->count() > 0)
                                @foreach ($team as $key => $member)
                                    <div class="team-item">
                                        <div class="team-image">
                                            @if ($member->image)
                                                <img src="/images/team/{{ $member->image }}" alt="">
                                            @else
                                                <img src="/fronts/img/new/avatar.png" alt="">
                                            @endif
                                        </div>
                                        <div class="team-contacts">
                                            <p>{{ $member->translation->name }}</p>
                                            <p>{{ $member->translation->function }}</p>
                                            @if ( $member->translation->email)
                                                <a href="{{ $member->translation->email }}">{{ $member->translation->email }}</a>
                                            @endif
                                            @if ($member->translation->phone)
                                                <a href="tel:{{ $member->translation->phone }}">{{ $member->translation->phone }}</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="accordion" id="accordion">

                            @if ($departments->count() > 0)
                                @foreach ($departments as $key => $department)
                                    <div class="cke-content cke-content-accordion">
                                        <p
                                            class="title"
                                            data-toggle="collapse"
                                            data-target="#departament{{ $department->id }}"
                                            aria-expanded="false"
                                            aria-controls="departament{{ $department->id }}"
                                            >
                                            {{ $department->translation->name }}
                                        </p>
                                        <div class="collapse" id="departament{{ $department->id }}" data-parent="#accordion">
                                            <div class="card card-body">

                                                @if ($department->teams()->count() > 0)
                                                    @foreach ($department->teams as $key => $member)
                                                        <div class="team-item">
                                                            <div class="team-image">
                                                                @if ($member->image)
                                                                    <img src="/images/team/{{ $member->image }}" alt="">
                                                                @else
                                                                    <img src="/fronts/img/new/avatar.png" alt="">
                                                                @endif
                                                            </div>
                                                            <div class="team-contacts">
                                                                <p>{{ $member->translation->name }}</p>
                                                                <p>{{ $member->translation->function }}</p>
                                                                @if ( $member->translation->email)
                                                                    <a href="{{ $member->translation->email }}">{{ $member->translation->email }}</a>
                                                                @endif
                                                                @if ($member->translation->phone)
                                                                    <a href="tel:{{ $member->translation->phone }}">{{ $member->translation->phone }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 posrelative">
                    <form action="{{ url('/'.$lang->lang.'/contact-feed-back') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>{{ trans('vars.Contacts.sendUsMessage') }}</p>
                        <input type="text" name="name" required placeholder="{{ trans('vars.Contacts.contactsFormNameLabel') }}" />
                        <input type="number" name="phone" required placeholder="{{ trans('vars.Contacts.contactsFormPhoneLabel') }}" />
                        <input type="email" name="email" required placeholder="{{ trans('vars.Contacts.contactsLabelEmailLabel') }}" />
                        <textarea cols="30" rows="20" required name="message" placeholder="{{ trans('vars.Contacts.contactsFormMessageBodyLabel') }}"></textarea>
                        <input type="submit" value="{{ trans('vars.Contacts.contactsFormButtonText') }}Trimite" />
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop
