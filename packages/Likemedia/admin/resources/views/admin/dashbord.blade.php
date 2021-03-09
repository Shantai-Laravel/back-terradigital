@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
@include('admin::admin.alerts')

<article class="dashboard-page">
    <section class="section">

        <div class="alert alert-warning text-center alert-block">
            Please wait..<br>
            do not reload the page until the process is completed
            <div class="">
                <img src="/admin/4V0b.gif">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @php
                    $setting = getSettings();
                @endphp
                <h6>
                    Notification section: 
                    @if ($setting['promotions'] == 'active')
                        <a href="{{ url('/back/promotions/set-all-stauts') }}"><span class="label label-success"> active</span></a>
                    @else
                        <a href="{{ url('/back/promotions/set-all-stauts') }}"><span class="label label-danger">inactive</span></a>
                    @endif
                </h6>
            </div>
        </div>
        <hr>

        <div class="row sameheight-container">
            @if(!is_null($menu))
            @foreach($menu as $item)
                @if ($item->on_dashboard)

            <div class="col col-xs-12 col-sm-12 col-md-6 col-xl-6 stats-col">
                <div class="card sameheight-item stats" data-exclude="xs">
                    <div class="card-block">
                        <div class="title-block">
                            <h4 class="title">
                                <a href="#">
                                    {{ $item->name }}
                                </a>
                            </h4>
                        </div>
                        <div class="row row-sm stats-container">
                            <div class="col-xs-12 col-sm-6 stat-col">
                                <div class="stat-icon"> <i class="fa {{ $item->icon }}"></i> </div>
                                <div class="stat">
                                    <div class="value"> {{ moduleItems($item->table_name) }} </div>
                                    <div class="name"> quantity  </div>
                                </div>
                                <progress class="progress stat-progress" value="90" max="100">
                                    <div class="progress">
                                        <span class="progress-bar" style="width: 15%;"></span>
                                    </div>
                                </progress>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
            @endif
        </div>
    </section>
</article>

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
<style media="screen">
    .alert-block{
        display: none;
        position: relative;
    }
    .alert-block img{
        width: 50px;
        position: absolute;
        right: 10px;
        top: 10px;
    }
    .label{
        font-size: 90%;
    }
    a:not(.btn){
        text-decoration: none;
    }
</style>
<script>
    $('.run-alert').on('click', function(){
        $('.alert-block').show();
    });
</script>
@stop
