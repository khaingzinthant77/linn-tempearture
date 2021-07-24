@extends('adminlte::page')

@section('title', 'Temperature')

@section('content_header')
<div class="row">
  <div class="col-md-4">
     <a class="btn btn-primary unicode btn-sm" href="{{route('temperature.index')}}"> Back</a>
  </div>
   <div class="col-md-4">
     <h6 class="text-center">{{$employees->name}} 's Temperature Information</h6>
   </div>
    <div class="col-md-4 text-right">
      
    </div>
</div>

@stop

@section('content')
           
 <?php
  $year = isset($_GET['year'])?$_GET['year']:''; 
  $month = isset($_GET['month'])?$_GET['month']:''; 
  ?>

  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-2" align="center">
            @if($employees->photo == '')
              <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="90px">
            @else
               <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="80px" height="90px"> 
            @endif
    </div>
    <div class="col-md-6">
      <p class="text-dark text-md"><b>{{$employees->name}}</b></p>
      <p>{{$employees->emp_id}}</p>
      <p>{{$employees->viewDepartment->name}} ({{$employees->viewBranch->name}})</p>
    </div>
  </div>

 

<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
        <th style="text-align: center;">Day</th>
        <th style="text-align: center;">Month</th>
        <th style="text-align: center;">Year</th>
        <th style="text-align: center;">Temperature_No</th>
        <th>Action</th>
			</tr>
		</thead>
    <tbody>
    @if($count>0)
     @foreach($temperatures as $temperature)
      @if($temperature->emp_id == $employees->id)
       <tr style=" background-color: #c7d4dd;">
        <td>{{$temperature->day}}</td>
        <td>{{$temperature->month}}</td>
        <td>{{$temperature->year}}</td>
        <td>{{$temperature->temperture_no}}</td>
        <td>
                  <form action="{{route('temperature.destroy',$temperature->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                    @csrf
                    @method('DELETE')
                    
                    <a class="btn btn-sm btn-primary" href="{{route('temperature.edit',$temperature->id)}}" ><i class="fa fa-fw fa-edit" style="padding-top: 5px;padding-bottom: 5px;padding-left: 2px;padding-right: 5px"/></i></a> 
                  
                     <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 10px"><i class="fa fa-fw fa-trash" /></i></button> 
                    
                   </form>
                </td>
      
      </tr>
      @endif
      @endforeach
       @else
         <tr align="center">
            <td colspan="5">No Data!</td>
         </tr>
         @endif   
    </tbody>

	
	</table>
{{-- {!! $temperatures->appends(request()->input())->links() !!} --}}
</div>
<p >Total record:{{$count}} </p>

@stop 



@section('css')
<link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet"/>
@stop

@section('js')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
 $(document).ready(function(){
   $(function() {
    
     $("#year").datepicker({  format: "yyyy",
    viewMode: "years", 
    minViewMode: "years" });

      $("#month").datepicker({  format: "MM",
            viewMode: "months", 
            minViewMode: "months" });
       
   });


   $(function() {
     $('#year').on('change',function(e) {
        this.form.submit();
               // $( "#form_id" )[0].submit();   
      });

     $('#month').on('change',function(e) {
        this.form.submit();
               // $( "#form_id" )[0].submit();   
      });

   });
});
 </script>
        
@stop