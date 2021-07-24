@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('room.update',$rooms->id)}}" method="post" enctype="multipart/form-data">
        @csrf
       @method('PUT')
       <div class="row">
               
        <label class="col-md-2 unicode">Hostel</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <select class="form-control form-group" id="hostel_id" name="hostel_id" style="font-size: 14px;">
          @foreach($hostels as $hostel)
            <option value="{{$hostel->id}}" {{($hostel ->hostel_id == $hostel->id)?'selected':''}} class="fontStyle">
              {{$hostel->name}}
            </option>
            @endforeach
          </select>
         
        </div>    
    </div>
    <div class="row">
               
        <label class="col-md-2 unicode">Room No</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            <input type="text" name="room_no" id="room_no" class="form-control unicode" value="{{$rooms->room_no}}">
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('room.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Update
                    </button>
                    </div>
            </div>

        </form>
    </div>
@stop