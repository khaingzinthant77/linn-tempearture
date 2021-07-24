@extends('adminlte::page')

@section('title', 'NRCState')

@section('content_header')
@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
        <form action="{{route('nrcstate.update',$nrcstates->id)}}" method="POST" >
        @csrf
       @method('PUT')

        <div class="row">
               
        <label class="col-md-2 unicode">NRCCode Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
          <select class="form-control form-group" id="code_id" name="code_id" style="font-size: 14px;">
          @foreach($codes as $code)
            <option value="{{$code->id}}" {{($nrcstates ->code_id == $code->id)?'selected':''}} class="fontStyle">
              {{$code->name}}
            </option>
            @endforeach
          </select>
         
        </div>    
        </div><br>

       <div class="row">
               
        <label class="col-md-2 unicode">NRCState Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <input type="text" name="name" id="name" class="form-control unicode" value="{{$nrcstates->name}}">
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('nrcstate.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode">Update</button>
                    </div>
            </div>

        </form>
    </div>
@stop