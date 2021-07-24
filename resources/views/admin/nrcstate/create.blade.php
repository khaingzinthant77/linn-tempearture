@extends('adminlte::page')

@section('title', 'NRCState')

@section('content_header')
@stop
@section('content')
 <div class="container">
        <form action="{{route('nrcstate.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
               
        <label class="col-md-2 unicode">NRCCode Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
          <select class="form-control" name="code_id" style="font-size: 13px">
                <option value="">select nrccode</option>
                @foreach ($codes as $code )
                  <option  value="{{$code->id}}">{{$code->name}}</option>
                @endforeach
            </select>   
         
        </div>    
        </div><br>

       <div class="row">
               
        <label class="col-md-2 unicode">NRCState Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <input type="text" name="name" placeholder="Enter nrcstate name" class="form-control" style="font-size: 13px"> 
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('nrcstate.index')}}"> Back</a>
                        <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Save
                         </button>
                    </div>
            </div>

        </form>
    </div>
@stop