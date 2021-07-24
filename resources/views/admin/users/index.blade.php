@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
<h5 style="color: blue;">User Management</h5>
    
@stop

@section('content')
<?php
        $keyword = isset($_GET['keyword'])?$_GET['keyword']:'';
?>

<a class="btn btn-success unicode" href="{{ route('users.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Create New User</a>

<form action="{{route('users.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row">
       <div class="col-md-3">                 
          <input type="text" name="keyword" id="keyword" value="{{ old('keyword',$keyword) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
    </form>
<br>




<div class="table-responsive" style="font-size:14px">
  <table class="table table-bordered styled-table">
     <thead>
       <tr>
         <th>No</th>
         <th>Name</th>
         <th>Email</th>
         <th>Roles</th>
         <th width="280px">Action</th>
       </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $user)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td>
               <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
               <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td> 
          </tr>
         @endforeach
      </tbody>  
  </table>
</div>


{!! $data->render() !!}

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
@stop

@section('js')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
<script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
<script type="text/javascript">
  @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
</script>
@stop