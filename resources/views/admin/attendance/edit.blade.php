@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<style type="text/css">
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
    position: absolute;
    top: 2px;
    right: 0px;
    left: 365px;
    width: 100px; }
</style>
@stop
@section('content')
 <div class="container" >
        <form action="{{route('attendance.update',$attendance->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
             <select class="livesearch form-control" name="emp_id">
                @foreach ($employees as $employee )
                  <option  value="{{$employee->id}}" {{ (old('emp_id',$attendance->emp_id)==$employee->id)?'selected':'' }}>{{$employee->name}}</option>
                @endforeach
            </select>
         
        </div>    
    </div><br>
    
      <div class="row">
               
        <label class="col-md-2 unicode">Time In</label>
        <div class="col-md-5 ">
            
           <input type="text" class="form-control bs-timepicker" name="clock_in" id="clock_in" value="{{$attendance->clock_in}}">
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Time In Date</label>
        <div class="col-md-5">
            
            <input type="text" name="date" id="date" class="form-control" value="{{date('d-m-Y',strtotime($attendance->date))}}">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Time Out</label>
        <div class="col-md-5">
            
            <input type="text" class="form-control bs-timepicker" name="clock_out" id="clock_out" value="{{$attendance->clock_out}}">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Time Out Date</label>
        <div class="col-md-5">
            
            <input type="text" name="out_date" id="out_date" class="form-control" value="{{date('d-m-Y',strtotime($attendance->out_date))}}">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Attendance Status</label>
        <div class="col-md-5">
            
            <select class="form-control" id="attendance_status" name="attendance_status" style="font-size: 13px">
                 <option value="">All</option>  
                <option value="1" {{old('attendance_status',$attendance->attendance_status == 1 ? 'Selected':'')}}>Present</option>
                <option value="2" {{old('attendance_status',$attendance->attendance_status == 2 ? 'Selected':'')}}>Absent</option>
                <option value="3" {{old('attendance_status',$attendance->attendance_status == 3 ? 'Selected':'')}}>Leave</option>
               </select>
         
        </div>    
    </div><br>
    <!-- <div class="row">
               
        <label class="col-md-2 unicode">Clock In IP Address</label>
        <div class="col-md-5 {{ $errors->first('clockin_ip_address', 'has-error') }}">
            
            <input type="text" name="clockin_ip_address" id="clockin_ip_address" class="form-control" value="{{$attendance->clockin_ip_address}}">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Clock Out IP Address</label>
        <div class="col-md-5 {{ $errors->first('clockout_ip_address', 'has-error') }}">
            
            <input type="text" name="clockout_ip_address" id="clockout_ip_address" class="form-control" value="{{$attendance->clockout_ip_address}}">
         
        </div>    
    </div><br> -->
    <div class="row">
               
        <label class="col-md-2 unicode">Working From</label>
        <div class="col-md-5 {{ $errors->first('working_from', 'has-error') }}">
            
            <input type="text" name="working_from" id="working_from" class="form-control" value="{{$attendance->working_from}}">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Note</label>
        <div class="col-md-5 {{ $errors->first('note', 'has-error') }}">
            
            <input type="text" name="note" id="note" class="form-control" value="{{$attendance->note}}">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Is Late</label>
        <div class="col-md-5">
            
             <select class="form-control" id="is_late" name="is_late" style="font-size: 13px">
                <!-- <option value="">All</option>   -->
                <option value="0" {{old('is_late',$attendance->is_late == 0 ? 'Selected':'')}}>No</option>
                <option value="1" {{old('is_late',$attendance->is_late == 1 ? 'Selected':'')}}>Yes</option>
               </select>
         
        </div>    
    </div><br>

     <div class="row" id="reason">
               
        <label class="col-md-2 unicode">Reason</label>
        <div class="col-md-5">
            
            <textarea class="form-control" id="reason" name="reason">{{$attendance->reason}}</textarea>
        </div>    
    </div><br id="break">

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('attendance.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Save
                    </button>
                    </div>
            </div>

        </form>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
<link rel="stylesheet" href="{{asset('dist/css/timepicker.min.css')}}">
@stop

@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
 <script src="{{asset('dist/js/timepicker.min.js')}}"></script>
<script type="text/javascript">
     $(document).ready(function(){
        var val = $('#is_late option:selected').val();
                if (val == '1') {
                    $("#reason").show();
                    $("#break").show();
                } else {
                    $("#reason").hide();
                    $("#break").hide();
                }
        $(function() {
            $('.livesearch').select2({
            placeholder: 'Employee Name',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-search")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });

        $("#date").datepicker({ format: 'dd-mm-yyyy' });
        $("#out_date").datepicker({ format: 'dd-mm-yyyy' });

});
       $(function () {
            $('#clock_in').timepicker();
          });
       $(function () {
            $('#clock_out').timepicker();
          });
</script>
@stop