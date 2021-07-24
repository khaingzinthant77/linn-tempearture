@extends('adminlte::page')

@section('title', 'NRCCode')

@section('content_header')
@stop
@section('content')
  <div class="container" >
        <form action="{{route('nrccode.update',$nrccodes->id)}}" method="POST" >
        @csrf
       @method('PUT')

       <div class="row">
               
        <label class="col-md-2 unicode">NRCCode Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" value="{{$nrccodes->name}}" class="form-control unicode">
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('nrccode.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode">Update</button>
                    </div>
            </div>

        </form>
    </div>
@stop