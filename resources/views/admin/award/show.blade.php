@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')

@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('award.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('award.destroy',$award->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            @can('award-edit')
                            <a class="btn btn-sm btn-primary" href="{{route('award.edit',$award->id)}}"><i class="fa fa-fw fa-edit" /></i></a>
                            @endcan
                            @can('award-delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                            @endcan
          </form>
        </div>
    </div>
</div><br>
 <div class="container" >
        <form action="{{route('award.update',$award->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <!-- <select class="livesearch form-control" name="emp_id"></select> -->
            <input type="text" name="emp_id" value="{{$award->employee->name}}" id="emp_id" class="form-control" readonly="readonly">
         
        </div>    
    </div><br>
    
    
      <div class="row">
               
        <label class="col-md-2 unicode">Award Name</label>
        <div class="col-md-5 {{ $errors->first('award_name', 'has-error') }}">
            
            <input type="text" name="award_name" id="award_name" class="form-control" value="{{$award->award_name}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Gift</label>
        <div class="col-md-5 {{ $errors->first('gift', 'has-error') }}">
            
            <input type="text" name="gift" id="gift" class="form-control" value="{{$award->gift}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Cash Price</label>
        <div class="col-md-5 {{ $errors->first('cash_price', 'has-error') }}">
            
            <input type="text" name="cash_price" id="cash_price" class="form-control" value="{{$award->cash_price}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Month</label>
        <div class="col-md-5 {{ $errors->first('month', 'has-error') }}">
            
            <input type="text" name="month" id="month" class="form-control" value="{{$award->month}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Year</label>
        <div class="col-md-5 {{ $errors->first('year', 'has-error') }}">
            
            <input type="text" name="year" id="year" class="form-control" value="{{$award->year}}" readonly="readonly">
         
        </div>    
    </div><br>


        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop