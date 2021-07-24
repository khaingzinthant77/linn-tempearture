@extends('adminlte::page')
@section('title', 'Temperature')
@section('content_header')
<meta name="viewport" content="width=device-width, initial-scale=1">
<h5 style="color: blue;">Temperature Management</h5>
@stop
@section('content')
<?php
  
   $hostel_id = isset($_GET['hostel_id'])?$_GET['hostel_id']:''; 
   $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
   $year = isset($_GET['year'])?$_GET['year']:'';
   $month = isset($_GET['month'])?$_GET['month']:'';
  
 ?>
 <a class="btn btn-warning btn-sm" style="font-size: 13px;float: right;" href="{{route('temperature.create')}}"><i class="fa fa-fw fa-plus"></i>  Add Temperature</a> 
 

<form action="{{route('temperature.index')}}" method="get" accept-charset="utf-8" class="form-horizontal" >
   <div class="row form-group" id="adv_filter">
      <div class="col-md-12">
         <div class="row">
         
            <div class="col-md-2">
               <label for="">Select Hostel Name</label>
               <select class="form-control" id="hostel_id" name="hostel_id" style="font-size: 13px">
                  <option value="">All</option>
                  @foreach($hostels as $hostel)
                  <option value="{{$hostel->id}}" {{ (old('hostel_id',$hostel_id)==$hostel->id)?'selected':'' }}>{{$hostel->name}}</option>
                  @endforeach
               </select>
            </div>
            
              <div class="col-md-2">
               <label for="">Select Branch Name</label>
               <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                  <option value="">All</option>
                  @foreach($branchs as $branch)
                  <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                  @endforeach
               </select>
               </div>

               <!-- <div class="col-md-2">
                  <label for="">Month</label>
                  
                  <input type="text" name="month" id="month"class="form-control unicode" placeholder="June" value="{{ old('month',$month) }}" style="font-size: 13px">
               </div>

               <div class="col-md-2">
                  <label for="">Year</label>
                     <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px">
               </div>
               <div class="col-md-1" align="center">
                  <label for="">&nbsp;</label>
                  <button type="button" class="btn btn-danger" id="clear_search" >Clear</button>
               </div>
               <div class="col-md-1" align="center">
                  <label for="">&nbsp;</label>

                  <button type="submit" class="btn btn-primary " >Search</button>
               </div> -->

              
         </div>
      </div>
   </div>
</form>

<p style="padding-top: 20px">Total record: {{$count}}</p>
  <?php
         $now_year =  now()->year;
         $now_month = now()->month;
         if($now_month == '01'){
            $dates = "January";
        }elseif ($now_month == '02') {
            $dates = "February";
        }elseif ($now_month == '03') {
            $dates = "March";
        }elseif ($now_month == '04') {
            $dates = "April";
        }elseif ($now_month == '05') {
            $dates = "May";
        }elseif ($now_month == '06') {
            $dates = "June";
        }elseif ($now_month == '07') {
            $dates = "July";
        }elseif ($now_month == '08') {
            $dates = "August";
        }elseif ($now_month == '09') {
            $dates = "September";
        }elseif ($now_month == '10') {
            $dates = "October";
        }elseif ($now_month == '11') {
            $dates = "November";
        }elseif ($now_month == '12') {
            $dates = "December";
        }
        ?>
<div class="table-responsive" style="font-size:14px;overflow-x:auto;">
   <table class="table table-bordered styled-table ">
     @php $i = 1; @endphp
      <thead>
         <tr>
            <th style="text-align: center">No</th>
            <th style="text-align: center">Photo</th>
            @for($i; $i<=date('t');$i++)
            <th style="text-align: center">{{$i}}/{{$now_month}}/{{$now_year}}</th>
            @endfor
            <!-- <th style="text-align: center">02/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">03/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">04/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">05/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">06/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">07/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">08/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">09/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">10/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">11/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">12/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">13/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">14/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">15/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">16/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">17/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">18/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">19/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">20/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">21/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">22/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">23/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">24/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">25/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">26/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">27/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">28/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">29/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">30/{{$now_month}}/{{$now_year}}</th>
            <th style="text-align: center">31/{{$now_month}}/{{$now_year}}</th> -->
            <!-- <th colspan="12" style="text-align: center;" style="width: 250px">Month</th> -->
         </tr>
        
      </thead>
      
      <tbody>
          
         @if($employees->count()>0)
         @foreach($employees as $employee)
         <tr class="table-tr" >
             <td data-url="{{route('temperature.show',$employee->id)}}">
               <p style="width: 100px;font-weight: bold;"> {{$employee->emp_id}} </p>
               <p style="width: 100px;font-weight: bold;"> {{$employee->name}}</p>
            </td>
            @if($employee->photo == '')
            <td>
               <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
            </td>
            @else
            <td>
               <img src="{{ asset('uploads/employeePhoto/'.$employee->photo) }}" alt="photo" width="80px" height="80px">
            </td>
            @endif
            @php 
                $j=1; 
            @endphp
            @for($j; $j<=date('t');$j++)
            @php 
                $temp = "Empty";
                $temp_id = '';
            @endphp
             <td>
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == $j && $temperature->month == $dates && $temperature->year == $now_year)
                        @php 
                            $temp = $temperature->temperture_no; 
                            $temp_id =  $temperature->id;
                        @endphp
                    @endif    
                @endforeach

                @if($j <= date('d'))
                    @if($temp=="Empty")
                        <a href="" data-date="{{$now_year}}-{{$now_month}}-{{$j}}" style="color:black" class="update" data-name="{{ $employee->id}}" data-type="text" data-pk="{{ $temp_id}}" data-empid="{{ $employee->id}}">{{ $temp }}</a> 
                    @else
                        @if($temp >100)
                        <a href="" data-date="{{$now_year}}-{{$now_month}}-{{$j}}" style="color:red" class="update" data-name="{{ $employee->id}}" data-type="text" data-pk="{{ $temp_id}}" data-empid="{{ $employee->id}}">{{ $temp }}</a> 
                        @else
                        <a href="" data-date="{{$now_year}}-{{$now_month}}-{{$j}}" class="update" data-name="{{ $employee->id}}" data-type="text" data-pk="{{ $temp_id}}" data-empid="{{ $employee->id}}">{{ $temp }}</a> 
                        @endif
                    @endif
                @endif
            </td>
            @endfor
            <!-- <td>
                @php
                $temp = '';
                @endphp
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == "02" && $temperature->month == $dates && $temperature->year == $now_year)
                        @php $temp = $temperature->temperture_no; @endphp
                    @endif    
                @endforeach

                <a href="" class="update" data-name="temperature" data-type="text" data-pk="">{{ $temp }}</a> 
    
                
            </td>
            <td>
            @php
                $temp = '';
                @endphp
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == "03" && $temperature->month == $dates && $temperature->year == $now_year)
                        @php $temp = $temperature->temperture_no; @endphp
                    @endif    
                @endforeach

                <a href="" class="update" data-name="temperature" data-type="text" data-pk="">{{ $temp }}</a> 
    
                
            </td>
            <td>
            @php
                $temp = '';
                @endphp
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == "04" && $temperature->month == $dates && $temperature->year == $now_year)
                        @php $temp = $temperature->temperture_no; @endphp
                    @endif    
                @endforeach

                <a href="" class="update" data-name="temperature" data-type="text" data-pk="">{{ $temp }}</a> 
    
                
            </td>
            <td>
            @php
                $temp = '';
                @endphp
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == "05" && $temperature->month == $dates && $temperature->year == $now_year)
                        @php $temp = $temperature->temperture_no; @endphp
                    @endif    
                @endforeach

                <a href="" class="update" data-name="temperature" data-type="text" data-pk="">{{ $temp }}</a> 
    
                
            </td>
            <td>
            @php
                $temp = '';
                @endphp
                @foreach($employee->viewTemperature as $temperature)
               
                    @if($temperature->day == "06" && $temperature->month == $dates && $temperature->year == $now_year)
                        @php $temp = $temperature->temperture_no; @endphp
                    @endif    
                @endforeach

                <a href="" class="update" data-name="temperature" data-type="text" data-pk="">{{ $temp }}</a> 
    
                
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "07" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "08" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "09" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "10" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "11" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "12" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "13" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "14" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "15" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "16" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "17" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "18" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "19" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "20" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "21" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "22" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "23" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "24" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "25" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "26" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "27" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "28" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "29" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "30" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td>
            <td>
               @foreach($employee->viewTemperature as $temperature)
               
               @if($temperature->day == "31" && $temperature->month == $dates && $temperature->year == $now_year)
               {{
               $temperature->temperture_no
               }}
               @endif
              
               @endforeach
            </td> -->

         
            
         </tr>
        
         @endforeach
         @else
         <tr align="center">
            <td colspan="10">No Data!</td>
         </tr>
         @endif   
     
      </tbody>
   </table>
{{ $employees->appends(['sort' => 'votes'])->links() }}
</div>
@stop 
@section('css')
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop
@section('js')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
{{-- <script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script> --}}
<script>$.fn.poshytip={defaults:null}</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript">
   @if(Session::has('success'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif
       $(function() {
          $('table').on("click", "tr.table-tr td:first-child", function() {
            window.location = $(this).data("url");
          });

         $('#hostel_id').on('change',function(e){
            this.form.submit();
         });
           
         $('#branch_id').on('change',function(e){
            this.form.submit();
         });

         $("#year").datepicker({  format: "yyyy",
              viewMode: "years", 
              minViewMode: "years" }); 

         $("#month").datepicker({  format: "MM",
              viewMode: "months", 
              minViewMode: "months" });

         $(document).find("#clear_search").click(function(){
               $(document).find("select").val('');
               $(document).find("input").val('');
         });

      });

  

        $.fn.editable.defaults.mode = 'inline';
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 
  
    $('.update').editable({
           url: "{{ route('temperature.ajaxupdate') }}",
           type: 'text',
           pk: 1,
           name: 'temp',
           title: 'Enter tempearture',
           params: function(params) {

            // add additional params from data-attributes of trigger element

            params.empid = $(this).editable().data('empid');
            params.date = $(this).editable().data('date');

            return params;

            },

            success: function(response, newValue) {
                console.log(response.success);

            }
    });

</script>
@stop