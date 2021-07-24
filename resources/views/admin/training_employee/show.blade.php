@extends('adminlte::page')

@section('title', 'Training Employee')

@section('content_header')
@stop
@section('content')
<a class="btn btn-primary unicode" href="{{route('training_emp.index')}}"> Back</a><br><br>
 <div class="row">
     <div class="col-md-3">
        @if($training_employees->viewEmployee->photo == '')
         <div style="text-align: center;">
         <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" style="width: 20% !important">
         </div>
        @else
        <div style="text-align: center;">
         <img src="{{ asset('uploads/employeePhoto/'.$training_employees->viewEmployee->photo) }}" alt="photo" width="100px" height="100px">
        </div>
        @endif
        <div style="text-align: center;">
            <h6 style="margin-top: 10px">{{$training_employees->viewEmployee->name}}</h6>
        </div>
        <!--  <div style="text-align: center;">
            <h6 style="margin-top: 10px">{{$training_employees->viewTraining->name}}</h6>
        </div> -->
        <div style="text-align: center;margin-top:20px">
         <a id="attendance" style="color: white;padding-left: 10px;padding-right: 10px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Training Attendance</a>
      </div>
      <div style="text-align: center;margin-top:20px">
         <a id="result" style="color: white;padding-left: 40px;padding-right: 40px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Test Result</a>
      </div>


     </div>
     <div class="col-md-9">
          <div class="table-responsive" id="attendance_table">
         <table class="table table-bordered styled-table unicode">
            <thead>
               <tr>
                  <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Training Attendance</th>
               </tr>
            </thead>
            <tbody>
                <tr>
                  <td>Training Name <span style="padding-left: 80px">{{$training_employees->viewTraining->name}}</span></td>
                </tr>
                @if($attendance->count()>0)
                @foreach($attendance as $attendaces)
                <tr>
                  <td>Attendance Date <span style="padding-left: 63px">{{date('d-m-Y',strtotime($attendaces->att_date))}}</span></td>
                </tr>
               
                <tr>
                  <td>Status <span style="padding-left: 130px">{{$attendaces->status == '0' ? 'Present' : 'Absent'}}</span></td>
                </tr>
                 <tr>
                  <td>Remark <span style="padding-left:120px">{{$attendaces->remark}}</span></td>
                </tr>
                 @endforeach
                @endif


            </tbody> 
         </table>
      </div>
       <div class="table-responsive" id="result_table">
         <table class="table table-bordered styled-table unicode">
            <thead>
               <tr>
                  <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Test Result</th>
               </tr>
            </thead>
            <tbody>
              @if($test_results->count()>0)
              @foreach($test_results as $test_result)
               <tr>
                  <td>Train Name<span style="padding-left: 100px">{{$test_result->viewTraining->name}}</span></td>
               </tr>
              
               <tr>
                 <td>Test Date <span style="padding-left: 110px">{{date('d-m-Y',strtotime($test_result->test_date))}}</span></td>
               </tr>
               <tr>
                 <td>Mark <span style="padding-left: 140px">{{$test_result->marks}}</span></td>
               </tr>
               <tr>
                 <td>Remark <span style="padding-left: 120px">{{$test_result->remark}}</span></td>
               </tr>
                @endforeach
               @endif
              
            </tbody>
         </table>
      </div>

     </div>

 </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>

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

<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">
   $("#result_table").hide();
   $("#attendance").css('color', '#2a3c66'); 
   $("#attendance").css('border', '1px solid'); 
   $("#attendance").css('border-color', '#2a3c66');

   $("#result").css('color', 'white'); 
   $("#result").css('background-color', '#2a3c66'); 

   $("#attendance").click(function(){
       $("#attendance_table").show();
       $("#result_table").hide();
       
   
       $("#attendance").css('color', '#2a3c66'); 
       $("#attendance").css('border', '1px solid'); 
       $("#attendance").css('border-color', '#2a3c66');
       $("#attendance").css('background-color', 'white');

       $("#result").css('color', 'white'); 
       $("#result").css('background-color', '#2a3c66'); 
   
     
   });

   $("#result").click(function(){
       $("#attendance_table").hide();
       $("#result_table").show();
       
   
       $("#result").css('color', '#2a3c66'); 
       $("#result").css('border', '1px solid'); 
       $("#result").css('border-color', '#2a3c66');
       $("#result").css('background-color', 'white');

       $("#attendance").css('color', 'white'); 
       $("#attendance").css('background-color', '#2a3c66'); 
   
     
   });

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
        
        

});

</script>
@stop