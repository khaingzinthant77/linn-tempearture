@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('hostel.update',$hostels->id)}}" method="post" enctype="multipart/form-data">
        @csrf
         @method('PUT')
       <div class="row">
               
        <label class="col-md-2 unicode">Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" class="form-control unicode" value="{{$hostels->name}}">
         
        </div>    
    </div><br>

    
     <div class="row">
               
        <label class="col-md-2 unicode">Photo</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
          <input type="file" name="photo" class="form-control unicode" id="photo" placeholder="Hostel photo"><br>
          @if($hostels->photo != null)
          <img src="{{ asset($hostels->path.'/'. $hostels->photo) }}" alt="image" width="100px">
         @else
         <img src="{{ asset('uploads/images/download.png') }}" alt="photo" width="100px">
         @endif
        </div>    
    </div><br>


    <div class="row">
               
        <label class="col-md-2 unicode">Full Address</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <textarea name="full_address" rows="4" class="form-control unicode" id="address" placeholder="Paung Long 4 street,Pyinmana">{{$hostels->full_address}}</textarea>
           
         
        </div>    
    </div><br>



        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('hostel.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Update
                    </button>
                    </div>
            </div>

        </form>
    </div>
@stop