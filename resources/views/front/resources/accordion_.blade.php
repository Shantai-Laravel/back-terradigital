@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="cke-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{ $resource->translation->name }}</h3>
                <p>{!! $resource->translation->description !!}</p>
                <div class="accordion" id="accordion">
                    @if ($resource->children()->count() > 0)
                    @foreach ($resource->children as $key => $child)
                    @if ($child->accordions()->count() > 0)
                    <div class="cke-content cke-content-accordion">
                        <p
                            class="title"
                            data-toggle="collapse"
                            data-target="#collapseExample{{ $child->id }}"
                            aria-expanded="false"
                            aria-controls="collapseExample"
                            >
                            {{ $child->translation->name }}
                        </p>
                        <div class="collapse {{ $key == 0 ? "show in" : "" }}" id="collapseExample{{ $child->id }}" data-parent="#accordion">
                            <div class="card card-body">
                                <p>{{ $child->translation->description }} </p>
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
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@include('front.partials.footer')
@stop
