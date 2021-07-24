@extends('adminlte::page')

@section('title', 'Temperature')

@section('content_header')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
@stop

@section('content')
 
  
  <form action="{{route('temperature.update',$temperatures->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Employee Name</label>
                                </div>

                                <div class="col-md-8">

                                     <input type="text" name="name" class="form-control unicode" id="department" readonly value="{{$temperatures->name}}"> 

                                </div>
                            </div>
              </div>
        </div>

        

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Department</label>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="department" class="form-control unicode" id="department" readonly value="{{$temperatures->department}}" > 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Branch</label>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="branch" class="form-control unicode" id="branch" readonly value="{{$temperatures->branch}}" > 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Temperature Date</label>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="date" class="form-control unicode"  readonly value="{{$temperatures->temp_date}}"> 

                                </div>
                            </div>
              </div>
        </div>

         <input type="hidden" name="day" class="form-control unicode"  readonly value="{{$temperatures->day}}"> 
          <input type="hidden" name="month" class="form-control unicode"  readonly value="{{$temperatures->month}}"> 
           <input type="hidden" name="year" class="form-control unicode"  readonly value="{{$temperatures->year}}"> 
           <input type="hidden" name="emp_id" class="form-control unicode"  readonly value="{{$temperatures->emp_id}}"> 

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Temperature</label>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="temperture_no" class="form-control unicode" value="{{$temperatures->temperture_no}}" > 

                                </div>
                            </div>
              </div>
        </div>

      

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('temperature.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
                    </div>
            </div><br>
        	 
                        
        </div>
  </form>
@stop 



@section('css')

@stop



@section('js')
<script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
          $("#date").datepicker({ dateFormat: 'dd-mm-yy' });
    });
</script>
@stop