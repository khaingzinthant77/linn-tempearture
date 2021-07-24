@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h5>Edit Role</h5>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 text-center">
        <div class="form-group" style="margin-top: 5px;">
            <strong>&nbsp;</strong><br>
            <button type="submit" class="btn btn-success btn-sm">Save</button>
            <a class="btn btn-secondary btn-sm"  href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">

    </div>
</div>
<div class="row">
        <p><strong>Permissions:</strong></p><br>
        <div class="table-responsive" style="font-size:14px">
            <label for=""><input type="checkbox" id="checkAll"> Check All</label>
            <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Read</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>Delete</th>
                        {{-- <th>Export</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $i=>$permission)
                        @php
                            $ids = explode(',', $permission->ids);
                            $strArr = explode(',', $permission->name);
                        @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $permission->model }}</td>
                            @foreach($ids as $k=>$id)
                            <td>
                                 <label>{{ Form::checkbox('permission[]', $id, in_array($id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                </label>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>    
            </table>
        </div>
</div>
{!! Form::close() !!}
@stop
@section('css')
@stop

@section('js')
<script> 
   
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@stop