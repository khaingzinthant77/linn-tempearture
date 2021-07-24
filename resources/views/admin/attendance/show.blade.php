@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')

@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('attendance.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('attendance.destroy',$attendance->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
            @csrf
            @method('DELETE')
            @can('attendance-edit')
            <a class="btn btn-sm btn-primary" href="{{route('attendance.edit',$attendance->id)}}"><i class="fa fa-fw fa-edit" /></i></a>
            @endcan
            @can('attendance-delete')
            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button>
            @endcan 
          </form>
        </div>
    </div>
</div><br>
 <div class="container" >
        <form action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="text" name="emp_id" class="form-control" value="{{$attendance->employee->name}}" readonly="readonly">
         
        </div>    
    </div><br>
    
      <div class="row">
               
        <label class="col-md-2 unicode">Time In</label>
        <div class="col-md-5 ">
            
           <input type="text" class="form-control bs-timepicker" name="clock_in" id="clock_in" value="{{$attendance->clock_in}}" readonly="readonly">
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Time In Date</label>
        <div class="col-md-5">
            
            <input type="text" name="date" id="date" class="form-control" value="{{date('d-m-Y',strtotime($attendance->date))}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Time Out</label>
        <div class="col-md-5">
            
            <input type="text" class="form-control bs-timepicker" name="clock_out" id="clock_out" value="{{$attendance->clock_out}}" readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Time Out Date</label>
        <div class="col-md-5">
            
            <input type="text" name="out_date" id="out_date" class="form-control" @if($attendance->out_date != null) value="{{date('d-m-Y',strtotime($attendance->out_date))}}" @else value="" @endif readonly="readonly">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Attendance Status</label>
        <div class="col-md-5">
            
           <!--  <select class="form-control" id="attendance_status" name="attendance_status" style="font-size: 13px">
                <option value="">All</option>  
                <option value="1" {{old('attendance_status',$attendance->attendance_status == 1)}}>Present</option>
                <option value="2" {{old('attendance_status',$attendance->attendance_status == 2)}}>Absent</option>
                <option value="3" {{old('attendance_status',$attendance->attendance_status == 3)}}>Leave</option>
               </select> -->
               @if($attendance->attendance_status == 1)
               <input type="text" name="attendance_status" value="Present" readonly="readonly" class="form-control">
               @elseif($attendance->attendance_status == 2)
               <input type="text" name="attendance_status" value="Absent" readonly="readonly" class="form-control">
               @else
               <input type="text" name="attendance_status" value="Leave" readonly="readonly" class="form-control">
               @endif
         
        </div>    
    </div><br>
  <!--  <div class="row">
       <label class="col-md-2 unicode">Clock In IP Address</label>
       <div class="col-md-5">
            <input type="text" name="clockin_ip_address" id="clockin_ip_address" class="form-control" value="{{$attendance->clockin_ip_address}}" readonly="readonly">
       </div>
   </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Clock Out IP Address</label>
        <div class="col-md-5">
            
            <input type="text" name="clockout_ip_address" id="clockout_ip_address" class="form-control" value="{{$attendance->clockout_ip_address}}" readonly="readonly">
         
        </div>    
    </div><br> -->
    <div class="row">
               
        <label class="col-md-2 unicode">Working From</label>
        <div class="col-md-5 {{ $errors->first('working_from', 'has-error') }}">
            
            <input type="text" name="working_from" id="working_from" class="form-control" value="{{$attendance->working_from}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Note</label>
        <div class="col-md-5 {{ $errors->first('note', 'has-error') }}">
            
            <input type="text" name="note" id="note" class="form-control" value="{{$attendance->note}}" readonly="readonly">
         
        </div>    
    </div><br>
    <div class="row">
               
        <label class="col-md-2 unicode">Is Late</label>
        <div class="col-md-5">
          
               @if($attendance->is_late == 0)
                <input type="text" name="is_late" value="No" class="form-control" readonly="readonly">
                @else
                <input type="text" name="is_late" value="Yes" class="form-control" readonly="readonly">
                @endif
        </div>    
    </div><br>
    @if($attendance->is_late == 1)
    <div class="row">
               
        <label class="col-md-2 unicode">Reason</label>
        <div class="col-md-5">
          <textarea class="form-control" id="reason" name="reason">{{$attendance->reason}}</textarea>            
        </div>    
    </div><br>
    @endif

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

        $("#date").datepicker({ dateFormat: 'dd-mm-yy' });

});
       $(function () {
            $('#clock_in').timepicker();
          });
       $(function () {
            $('#clock_out').timepicker();
          });
</script>
@stop