
@extends('adminlte::page')

@section('title', 'Leave Type')

@section('content_header')
@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
         <form action="{{route('leave_type.update',$leave_type->id)}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf
        @method('PUT')
         <div class="row">
                 
          <label class="col-md-2 unicode">Leave Type</label>
          <div class="col-md-5 {{ $errors->first('leave_type', 'has-error') }}">
              
               <input type="text" name="leave_type" placeholder="Enter Leave Type" class="form-control" style="font-size: 13px" value="{{$leave_type->leave_type}}"> 
           
          </div>    
      </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Number of Leave</label>
        <div class="col-md-5 {{ $errors->first('num_of_leave', 'has-error') }}">
            
            <input type="number" name="num_of_leave" placeholder="2" class="form-control" style="font-size: 13px" value="{{$leave_type->num_of_leave}}">
         
        </div>    
               
        </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('leave_type.index')}}"> Back</a>
                        <button class="btn btn-success" type="submit" style="font-size: 13px">
                    Save
                     </button>
                    </div>
            </div>

        </form>
    </div>
@stop 
@section('css')
   <style type="text/css" media="screen">
        .error_msg{
            color: #DD4B39;
        }
        .has-error input{
            border-color: #DD4B39;
        }
        .jQWCP-wWidget{
            width: 300px !important;
            height: 200px !important;
        }
  </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('colorpicker/css/wheelcolorpicker.css')}} " />
   
@stop



@section('js')
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery-2.0.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('colorpicker/js/jquery.wheelcolorpicker-3.0.5.min.js') }} "></script>
    <script type="text/javascript">
        $(function() {
          $('#color-css').wheelColorPicker();
        });
    </script>
@stop