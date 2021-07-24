
@extends('adminlte::page')

@section('title', 'Leave Type')

@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('leave_type.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('leave_type.destroy',$leave_type->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-sm btn-primary" href="{{route('leave_type.edit',$leave_type->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
          </form>
        </div>
    </div>
</div><br>
 <div class="container" style="margin-top: 50px; ">
         <form action="{{route('leave_type.update',$leave_type->id)}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

         <div class="row">
                 
          <label class="col-md-2 unicode">Leave Type</label>
          <div class="col-md-5 {{ $errors->first('leave_type', 'has-error') }}">
              
               <input type="text" name="leave_type" placeholder="Enter Leave Type" class="form-control" style="font-size: 13px" value="{{$leave_type->leave_type}}" readonly="readonly"> 
           
          </div>    
      </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Number of Leave</label>
        <div class="col-md-5 {{ $errors->first('num_of_leave', 'has-error') }}">
            
            <input type="number" name="num_of_leave" placeholder="2" class="form-control" style="font-size: 13px" value="{{$leave_type->num_of_leave}}" readonly="readonly">
         
        </div>    
               
        </div><br>
        </form>
    </div>
@stop 
@section('css')

@stop



@section('js')

    </script>
@stop