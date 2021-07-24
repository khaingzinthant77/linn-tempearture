@extends('adminlte::page')

@section('title', 'Salary')

@section('content_header')
<div class="row">
  <div class="col-md-4">
     <a class="btn btn-primary unicode btn-sm" href="{{route('salary.index')}}"> Back</a>
  </div>
   <div class="col-md-4">
     <h6 class="text-center">{{$employees->name}} 's Salary Information</h6>
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

  <form action="{{route('salary.show',$employees->id)}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
          <div class="col-md-12">
          <div class="row payyear">
          <div class="col-md-2">
             <label for="">Payment year</label>
             <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}">
          </div>
{{--           <div class="col-md-2">
             <label for="">Payment Month</label>
             <input type="text" name="month" id="month"class="form-control unicode" placeholder="2021" value="{{ old('month',$month) }}">
          </div> --}}
          
        </div>
      </div>
    </div>
  </form>
<?php
  $salary_total = 0;
  $bonus_total = 0;
?>

<div class="table-responsive" style="font-size:15px;">
	<table class="table table-bordered styled-table">


		<thead>
			<tr>
        <th style="text-align: center;">Year</th>
				<th style="text-align: center;">Month</th>
				<th style="text-align: center;">Salary</th>
				<th style="text-align: center;">Bonus</th>
        <th style="text-align: center;">Total</th>
        <th>Action</th>
			</tr>
		</thead>
    <tbody>
      @foreach($salarys as $salary)
      @if($salary->emp_id == $employees->id)
      <tr>
        <td>{{$salary->year}}</td>
        <td>{{$salary->pay_date}}</td>
        <td style="text-align: right;">{{number_format($salary->salary_amt)}}</td>
        <td style="text-align: right;">{{number_format($salary->bonus)}}</td>
        <td style="text-align: right;">{{number_format($salary->month_total)}}</td>
        <?php
          $salary_total+= $salary->salary_amt;
          $bonus_total+= $salary->bonus;
        ?>
        
           <td>
                  <form action="{{route('salary.destroy',$salary->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                    @csrf
                    @method('DELETE')
                    @can('salary-edit')
                    <a class="btn btn-sm btn-primary" href="{{route('salary.edit',$salary->id)}}" ><i class="fa fa-fw fa-edit" style="padding-top: 5px;padding-bottom: 5px;padding-left: 2px;padding-right: 5px"/></i></a> 
                    @endcan
                    @can('salary-delete')
                     <button type="submit" class="btn btn-sm btn-danger" style="margin-left: 10px"><i class="fa fa-fw fa-trash" /></i></button> 
                     @endcan
                   </form>
                </td>
       
      </tr>
     
      @endif
      @endforeach
       <tr style=" background-color: #c7d4dd;">
        <td colspan="2">Grand Total</td>
        <td style="text-align: right;">{{number_format($salary_total)}}</td>
        <td style="text-align: right;">{{number_format($bonus_total)}}</td>
        <?php
        $total = 0;
        $total = $salary_total + $bonus_total;
        ?>
        <td style="text-align: right;">{{number_format($total)}}</td>
        <td></td>
      </tr>
    </tbody>

	
	</table>
  {{-- {!! $salarys->appends(request()->input())->links() !!} --}}

</div>
<p >Total record: {{$count}}</p>

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