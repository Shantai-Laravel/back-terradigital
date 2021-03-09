@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control panel</a></li>
        <li class="breadcrumb-item"><a href="{{ route('frontusers.index') }}">Admin Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Admin User</li>
    </ol>
</nav>

<div class="title-block">
    <h3 class="title"> Create User </h3>
    @include('admin::admin.list-elements', [
    'actions' => [
    trans('variables.add_element') => route('users.create'),
    ]
    ])
</div>

    <div class="list-content">
        <div class="tab-area">
            @include('admin::admin.alerts')
        </div>

        <form class="form-reg" role="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="part full-part">
            <h5>User Information:</h5>
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" class="username" id="username" required>
                </li>
                <li>
                    <label>Role</label>
                    <select name="role">
                        <option value="root">Root</option>
                        <option value="redactor">Redactor</option>
                        <option value="copyrighter">Copyrighter</option>
                        <option value="bibliotecar">bibliotecar</option>
                    </select>
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" name="password" class="name" id="password" required>
                </li>
                <li>
                    <label for="password-again">Password Again</label>
                    <input type="password" name="password-again" class="name" id="password-again" required>
                </li>
                <li>
                    <input type="submit" value="{{trans('variables.save_it')}}">
                </li>
            </ul>
          </div>
        </form>

    </div>


@stop

@section('footer')
    <footer>
        @include('admin::admin.footer')
    </footer>
@stop
