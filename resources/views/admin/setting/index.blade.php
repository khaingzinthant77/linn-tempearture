@extends('adminlte::page')

@section('title', 'Setting')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('setting.update',$setting->id)}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row"> 
                <label class="col-md-2 unicode">Logo</label>
                <div class="col-md-5 {{ $errors->first('logo', 'has-error') }}">    
                     <input type="file" name="logo" id="logo" class="form-control unicode" value="{{ $setting->logo }}">
                     <br>
                    <img src="{{ asset('/uploads/setting/'.$setting->logo) }}" alt="logo" width="150px">   
                </div>    
            </div><br>

            <div class="row"> 
                <label class="col-md-2 unicode">Favicon</label>
                <div class="col-md-5 {{ $errors->first('favicon', 'has-error') }}"> 
                    <input type="file" name="favicon" id="favicon" class="form-control unicode" value="{{ $setting->favicon }}">
                    <br>
                    <img src="{{ asset('/uploads/setting/'.$setting->favicon) }}" alt="favicon" width="30%">  
                   
                    
                </div>    
            </div><br>



            <div class="row"> 
                <label class="col-md-2 unicode">Title</label>
                <div class="col-md-5 {{ $errors->first('title', 'has-error') }}">        
                     <input type="text" name="title" id="title" class="form-control unicode" value="{{ $setting->title }}">
                </div>    
            </div><br>

            <div class="row">      
                <label class="col-md-2 unicode">Description</label>
                <div class="col-md-5 {{ $errors->first('description', 'has-error') }}">
                    <textarea name="description" id="description" class="form-control unicode">{{ $setting->description }}</textarea>
                </div>    
            </div><br>

            <div class="row"> 
                <label class="col-md-2 unicode">Api URL</label>
                <div class="col-md-5 {{ $errors->first('api_url', 'has-error') }}">        
                     <input type="text" name="api_url" id="api_url" class="form-control unicode" value="{{ $setting->api_url }}">
                </div>    
            </div><br>


            <div class="row"> 
                <label class="col-md-2 unicode">Api key</label>
                <div class="col-md-5 {{ $errors->first('api_key', 'has-error') }}">        
                     <input type="text" name="api_key" id="api_key" class="form-control unicode" value="{{ $setting->api_key }}">
                </div>    
            </div><br>
            <div class="row"> 
                <label class="col-md-2 unicode">Actual Time In</label>
                <div class="col-md-5 {{ $errors->first('actual_timein', 'has-error') }}">        
                     <input type="text" name="actual_timein" id="actual_timein" class="form-control bs-timepicker" value="{{ $setting->actual_timein }}">
                </div>    
            </div><br>
         



            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <a class="btn btn-primary unicode" href="{{route('room.index')}}"> Back</a>
                     <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                      Save
                    </button>
                </div>
            </div>

        </form>
    </div>
@stop
@section('css')
<link rel="stylesheet" href="{{asset('dist/css/timepicker.min.css')}}">
@stop

@section('js')
<script src="{{asset('dist/js/timepicker.min.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
         $(function () {
            $('.bs-timepicker').timepicker();
          });
    </script>
@stop