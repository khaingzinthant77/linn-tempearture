@extends('adminlte::page')

@section('title', 'Offday')

@section('content_header')
<div class="row"> 

  <div class="col-md-2">
       <a class="btn btn-primary unicode" href="{{route('offday.index')}}"> Back</a>
  </div>
  <div class="col-md-8 text-center">

  </div>
  <div class="col-md-2 text-right">
     
  </div>

</div>
@stop
@section('content')
 <div class="row">
    <div class="col-md-3">
        @if($emp_offdays[0]->viewEmployee->photo == '')
          <div style="text-align: center;">
             <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" style="width: 30% !important">
          </div>
           
        @else
            <div style="text-align: center;">
               <img src="{{ asset('uploads/employeePhoto/'.$emp_offdays[0]->viewEmployee->photo) }}" alt="photo" width="120px" height="140px">
            </div>
        @endif
        <div style="text-align: center;">
            <h6 style="margin-top: 10px">{{$emp_offdays[0]->viewEmployee->emp_id ? $emp_offdays[0]->viewEmployee->emp_id : "-"}}</h6>
            <h6>{{$emp_offdays[0]->viewEmployee->name ? $emp_offdays[0]->viewEmployee->name : "-" }}</h6>
            <h6>{{$emp_offdays[0]->viewEmployee->viewDepartment->name ? $emp_offdays[0]->viewEmployee->viewDepartment->name : "-" }}</h6>
            <h6>{{$emp_offdays[0]->viewEmployee->viewBranch->name ? $emp_offdays[0]->viewEmployee->viewBranch->name : "-" }}</h6>
        </div>
        <div style="text-align: center;margin-top:20px">
            <a id="calendar_view" style="color: white;padding-left: 65px;padding-right: 65px;border-width: 1px solid;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Calendar View</a>
        </div>
        <div style="text-align: center;margin-top: 20px">
            <a id="table_view" style="color: white;padding-left: 85px;padding-right: 85px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Table View</a>
        </div>
    </div>
     <div class="col-md-9"  align="center">
        <div  id="offday_calendar">
            <h6> Day Off Calendar View</h6> 
            <div id='calendar'></div>
        </div>
        <div class="table-responsive" id="offday_table">
            <h6> Day Off Table  View</h6> 
            <table class="table table-bordered styled-table">
                <thead>
                    <tr> 
                        <th>No</th>
                        <th>Day Off 1</th>
                        <th>Day Off 2</th>
                        <th>Day Off 3</th>
                        <th>Day Off 4</th>
                    </tr>
                </thead>
                <tbody>
                 @if($emp_offdays->count()>0)
                 @foreach($emp_offdays as $i=>$offday)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>@if($offday->off_day_1!='') {{date('d-m-Y',strtotime($offday->off_day_1))}} @endif</td>
                        <td>@if($offday->off_day_2!='') {{date('d-m-Y',strtotime($offday->off_day_2))}} @endif</td>
                        <td>@if($offday->off_day_3!='') {{date('d-m-Y',strtotime($offday->off_day_3))}} @endif</td>
                        <td>@if($offday->off_day_4!='') {{date('d-m-Y',strtotime($offday->off_day_4))}} @endif</td>
                    </tr>
                    @endforeach
                      @else
                      <tr align="center">
                        <td colspan="10">No Data!</td>
                      </tr>
                @endif    
                </tbody>
            </table> 
        </div>
    </div>
  </div>
@stop 


@section('css')
<link href='{{ asset("calender/fullcalendar.min.css") }}' rel='stylesheet' />
<link href='{{ asset("calender/fullcalendar.print.min.css") }}' rel='stylesheet' media='print' />
  <style>
     #calendar {
        max-width: 75%;
        margin: 0 auto;
        font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        font-size: 13px;
    }
    .fc-content{
      color: white;
    }
  </style>
@stop

<?php
    $arr1 = []; 
    $arr0 = [];
    foreach($emp_offday_arr as $emp_offday){
        $a = ['title'=>'နားရက်', 'start'=> date('Y-').date('m-d',strtotime($emp_offday)) ];
        array_push($arr1, $a);
        array_push($arr0,$a);
    }
    $date = date('Ymd')."";
?>

@section('js')
<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src='{{ asset("calender/moment.min.js") }}'></script>
<script src='{{ asset("calender/fullcalendar.min.js") }}'></script>
<script>

    $(function() {
         $("#offday_table").hide();
    });

    $("#table_view").css('color', '#2a3c66'); 
    $("#table_view").css('border', '1px solid'); 
    $("#table_view").css('border-color', '#2a3c66');

    $("#calendar_view").css('color', 'white'); 
    $("#calendar_view").css('background-color', '#2a3c66'); 

    $("#calendar_view").click(function(){
          $("#offday_table").hide();
          $("#offday_calendar").show();

        $("#table_view").css('color', '#2a3c66'); 
        $("#table_view").css('border', '1px solid'); 
        $("#table_view").css('border-color', '#2a3c66');
        $("#table_view").css('background-color', 'white');
        
        $("#calendar_view").css('color', 'white'); 
        $("#calendar_view").css('background-color', '#2a3c66'); 

    });
    
    $("#table_view").click(function(){
      $("#offday_table").show();
      $("#offday_calendar").hide();

      $("#calendar_view").css('color', '#2a3c66'); 
      $("#calendar_view").css('border', '1px solid'); 
      $("#calendar_view").css('border-color', '#2a3c66');
      $("#calendar_view").css('background-color', 'white');

      $("#table_view").css('color', 'white'); 
      $("#table_view").css('background-color', '#2a3c66'); 

    });

    $(document).ready(function() {
        // console.log(<?php echo json_encode($arr1); ?>);
        $('#calendar').fullCalendar({
            defaultDate: new Date(),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($arr1); ?>
        });
        
    });
</script>
@stop