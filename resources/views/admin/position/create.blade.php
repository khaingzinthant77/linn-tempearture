@extends('adminlte::page')

@section('title', 'Rank')

@section('content_header')
@stop
@section('content')
 <div class="container">
       <form action="{{route('position.store')}}" method="post" enctype="multipart/form-data">
        @csrf

       <div class="row">
               
        <label class="col-md-2 unicode">Rank Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            <input type="text" name="name" placeholder="Enter rank name" class="form-control" style="font-size: 13px">
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('position.index')}}"> Back</a>
                        <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                    Save
                     </button>
                    </div>
            </div>

        </form>
    </div>
@stop