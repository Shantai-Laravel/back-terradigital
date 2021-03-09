@section('nav-bar')
<div class="header-block header-block-collapse hidden-lg-up">
    <button class="collapse-btn" id="sidebar-collapse-btn"></button>
</div>
<div class="header-block header-block-buttons">
    <a href="{{ url('/') }}" target="_blank" class="btn btn-sm header-btn"> <span>Go to the site</span> </a>
    <a href="/auth/logout" class="btn btn-sm header-btn">  <span>Logout</span> </a>
</div>
<div class="header-block header-block-nav">
    <ul class="nav-profile">
        <li class="profile dropdown">
            <a class="nav-link" href="">
                <span class="name">Hi,
                    {{ Auth::user()->name }} <small class="label label-primary">{{ Auth::user()->role }}</small>
                </span>
            </a>
        </li>
    </ul>
</div>
@stop
