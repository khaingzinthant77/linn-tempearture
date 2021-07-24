@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')

<h5 style="color: blue;">Role Management</h5>
    
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            {{-- <h2>Role Management</h2> --}}
        </div>
        <div class="pull-right">
        @can('role-create')
            <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>
<br>


 {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
@endif --}}


<div class="table-responsive" style="font-size:14px">
  <table class="table table-bordered styled-table">
    <thead>
          <tr>
         <th>No</th>
         <th>Name</th>
         <th width="280px">Action</th>
    </tr>
    </thead>

    <tbody>
        @foreach ($roles as $key => $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $role->name }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                @can('role-edit')
                    <a class="btn btn-primary btn-sm " href="{{ route('roles.edit',$role->id) }}">Edit</a>
                @endcan
                @can('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{!! $roles->render() !!}


@endsection

@section('js')
 <script> 
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
