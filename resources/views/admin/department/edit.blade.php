@extends('adminlte::page')

@section('title', 'Department')

@section('content_header')
@stop
@section('content')

 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('department.update',$departments->id)}}" method="POST" >
        @csrf
       @method('PUT')

       <div class="row">
               
        <label class="col-md-2 unicode">Department Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" value="{{$departments->name}}" class="form-control unicode">
         
        </div>    
    </div><br>

       <!--   <div class="row">
               
        <label class="col-md-2 unicode">In Time</label>
        <div class="col-md-5">
            
            <input type="date" name="in_time" id="in_time" value="{{$departments->in_time}}" class="form-control unicode">
         
        </div>    
               
        </div><br>

          <div class="row">
               
        <label class="col-md-2 unicode">Out Time</label>
        <div class="col-md-5">
            
            <input type="date" name="out_time" id="out_time" value="{{$departments->out_time}}" class="form-control unicode">
         
        </div>    
               
        </div><br> -->
        <div class="row">
               
        <label class="col-md-2">Color</label>
        <div class="col-md-5">
             <input type="text" id="color-css" data-wcp-format="css" name="color_code" class="form-control unicode" placeholder=" Select Color " value="{{ $departments->dept_color }}">
             <button type="btn" class="btn" style="background-color: {{ $departments->dept_color }}"></button>
            {!! $errors->first('color_code', '<span class="error_msg unicode">:message</span> ') !!}
        </div>
        </div>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('department.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode">Update</button>
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