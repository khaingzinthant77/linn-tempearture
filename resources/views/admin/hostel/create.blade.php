@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('hostel.store')}}" method="post" enctype="multipart/form-data">
        @csrf
       <div class="row">
               
        <label class="col-md-2 unicode">Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" class="form-control unicode">
         
        </div>    
    </div><br>
    <div class="row">
        <div class="col-md-2">
            <h6 style="font-weight:bold;font-size:13px;">Photo</h6>
        </div>

        <div class="col-md-5 ">
            <input type="file" name="photo" class="form-control unicode">
        </div>
    </div><br>
    <div class="row">
                
        <label class="col-md-2 unicode">Full Address</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <textarea name="full_address" rows="4" class="form-control unicode" id="address" placeholder="Paung Long 4 street,Pyinmana"></textarea>
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('hostel.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Save
                    </button>
                    </div>
            </div>

        </form>
    </div>
@stop