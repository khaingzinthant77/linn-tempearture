@extends('adminlte::page')

@section('title', 'Actual Time In')

@section('content_header')
@stop
@section('content')

 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('actual_timein.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

       <div class="row">
               
        <label class="col-md-2 unicode">Actual Time In</label>
        <div class="col-md-5 {{ $errors->first('actual_timein', 'has-error') }}">

         <input type="text" class="form-control bs-timepicker" name="actual_timein">
        </div>    
    </div><br>
    
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('actual_timein.index')}}"> Back</a>
                        <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
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
   <link rel="stylesheet" href="{{asset('dist/css/timepicker.min.css')}}">

@stop


  

@section('js')

    <script src="{{asset('dist/js/timepicker.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
    $('.bs-timepicker').timepicker();
  });
    </script>
@stop