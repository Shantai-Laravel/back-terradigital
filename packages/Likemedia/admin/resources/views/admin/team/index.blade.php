@extends('admin::admin.app')
@include('admin::admin.nav-bar')
@include('admin::admin.left-menu')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/back') }}">Control Panel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Team</li>
    </ol>
</nav>
<div class="title-block"></div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-block">
                <h5><a class="btn btn-primary" href="{{ route('team.create') }}">add new</a> Team: </h5> <hr>
                <table class="table table-hover table-striped" id="tablelistsorter">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($team as $key => $member)
                        <tr id="{{ $member->id }}">
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $member->translation()->first()->name }}
                            </td>
                            <td>
                                @if (is_null($member->department))
                                    <small>---</small>
                                @else
                                    <small>{{ $member->department->translation->name }}</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('team.edit', $member->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td class="destroy-element">
                                <form action="{{ route('team.destroy', $member->id) }}" method="post">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button type="submit" class="btn-link">
                                    <a href=""><i class="fa fa-trash"></i></a>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=7></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-block">
                <h5><a class="btn btn-primary" href="#" data-toggle="modal" data-target=".addNewDep">add new</a> Departments: </h5> <hr>
                <table class="table table-hover table-striped" id="tablelistsorter">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th class="text-center">Memebers</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $key => $department)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $department->translation()->first()->name }}
                            </td>
                            <td class="text-center">
                                <span class="badge badge-success"> {{ $department->teams()->count() }} </span>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target=".editDep_{{ $department->id }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{url('/back/team/remove/department/'. $department->id )}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan=7></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade addNewDep" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6 class="modal-title">Add New Department</h6>
            </div>
            <form class="" action="{{ url('/back/team/add/new/department') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    @foreach ($langs as $key => $lang)
                        <div class="form-group">
                            <label for="">Title [{{ $lang->lang }}]</label>
                            <input type="text" name="title_{{ $lang->lang }}" value="" class="form-control" required>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($departments as $key => $department)
    <div class="modal fade editDep_{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h6 class="modal-title">Edit Department</h6>
                </div>
                <form class="" action="{{ url('/back/team/edit/department') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="department_id" value="{{ $department->id }}">
                    <div class="modal-body">
                        @foreach ($department->translations()->get() as $key => $translation)
                            <div class="form-group">
                                <label for="">Title [{{ $translation->lang->lang }}]</label>
                                <input type="text" name="title_{{ $translation->lang->lang }}" value="{{ $translation->name }}" class="form-control" required>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@stop
@section('footer')
<footer>
    @include('admin::admin.footer')
</footer>
@stop
