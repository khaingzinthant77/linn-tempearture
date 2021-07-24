@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('room.store')}}" method="post" enctype="multipart/form-data">
        @csrf
       <div class="row">
               
        <label class="col-md-2 unicode">Hostel</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <select class="form-control" name="hostel_id" style="font-size: 13px">
                <option value="">select hostel</option>
                @foreach ($hostels as $hostel )
                  <option  value="{{$hostel->id}}">{{$hostel->name}}</option>
                @endforeach
            </select>   
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Room No</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            <input type="text" name="room_no" id="room_no" class="form-control unicode">
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