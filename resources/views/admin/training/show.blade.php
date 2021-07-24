@extends('adminlte::page')

@section('title', 'Training')

@section('content_header')
@stop
@section('content')
 <a class="btn btn-primary unicode" href="{{route('training.index')}}"> Back</a><br><br>
 <div class="container" >
    <div class="row">
        <div class="col-md-3">
              <div style="text-align: center;margin-top:20px">
                <a id="training" style="color: white;padding-left: 42px;padding-right: 42px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Training</a>
              </div>
              <div style="text-align: center;margin-top:20px">
                <a id="employee" style="color: white;padding-left: 40px;padding-right: 40px;padding-top: 5px;padding-bottom: 5px;border-radius: 5px;cursor: pointer;">Employee</a>
              </div>
        </div>
        <div class="col-md-9">
             <div class="table-responsive" id="training_table">
                 <table class="table table-bordered styled-table unicode">
                    <thead>
                       <tr>
                          <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Training</th>
                       </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Training Name <span style="padding-left: 60px">{{$trainings->name}}</span></td>
                        </tr>
                        <tr>
                            <td>Description <span style="padding-left: 80px">{{$trainings->description}}</span></td>
                        </tr>
                        <tr>
                            <td>Period <span style="padding-left: 110px">{{$trainings->peroid}}</span></td>
                        </tr>
                        <tr>
                            <td>Start Date <span style="padding-left: 85px">{{date('d-m-Y',strtotime($trainings->start_date))}}</span></td>
                        </tr>
                        <tr>
                            <td>End Date <span style="padding-left: 90px">{{date('d-m-Y',strtotime($trainings->end_date))}}</span></td>
                        </tr>
                        <tr>
                            <td>Trainer Name <span style="padding-left: 65px">{{$trainings->trainer_name}}</span></td>
                        </tr>
                        <tr>
                            <td>Trainer Info <span style="padding-left: 75px">{{$trainings->trainer_info}}</span></td>
                        </tr>
                    </tbody> 
                 </table>
              </div>

                <div class="table-responsive" style="font-size:13px" id="employee_table">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>Name</th>
                      <th>Branch</th>
                      <th>Department</th>
                      <th>Position</th>
                      
                    </tr>
                  </thead>
                    <tbody>
                    @if($training_employees->count()>0)
                     @foreach($training_employees as $employee)
                       <tr>
                           <td>{{$employee->viewEmployee->name}}</td>
                            @foreach($branches as $branch)
                             @if($branch->id == $employee->viewEmployee->branch_id)
                            <td>{{$branch->name}}</td>
                             @endif
                             @endforeach

                             @foreach($departments as $department)
                              @if($department->id == $employee->viewEmployee->dep_id)
                              <td>{{$department->name}}</td>
                              @endif
                              @endforeach

                               @foreach($positions as $position)
                              @if($position->id == $employee->viewEmployee->position_id)
                              <td>{{$position->name}}</td>
                              @endif
                              @endforeach
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
   <!--  <div class="row">
               
        <label class="col-md-2 unicode">Name</label>
        <div class="col-md-5">
            
            <input type="text" name="name" id="name" class="form-control" value="{{$trainings->name}}" disabled>
         
        </div>    
    </div><br>

     <div class="row">
               
        <label class="col-md-2 unicode">Description</label>
        <div class="col-md-5">
            
            <input type="text" name="description" id="description" class="form-control" value="{{$trainings->description}}" disabled>
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Peroid </label>
        <div class="col-md-5">
            
            <input type="text" name="peroid" id="peroid " class="form-control" value="{{$trainings->peroid}}" disabled>
         
        </div>    
    </div><br>

   <div class="row">
               
        <label class="col-md-2 unicode">Start Date</label>
        <div class="col-md-5">
            
            <input type="text" name="start_date" id="start_date" class="form-control" value="{{date('d-m-Y',strtotime($trainings->start_date))}}" disabled>
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">End Date</label>
        <div class="col-md-5">
            
            <input type="text" name="end_date" id="end_date" class="form-control" value="{{date('d-m-Y',strtotime($trainings->end_date))}}" disabled>
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Trainer name</label>
        <div class="col-md-5">
            
            <input type="text" name="trainer_name" id="trainer_name" class="form-control" value="{{$trainings->trainer_name}}" disabled>
         
        </div>    
    </div><br>

     <div class="row">
               
        <label class="col-md-2 unicode">Trainer info </label>
        <div class="col-md-5">
            
            <input type="text" name="trainer_info" id="trainer_info " class="form-control" value="{{$trainings->trainer_info}}" disabled>
         
        </div>    
    </div><br>
<p>Employee</p>
      <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>Name</th>
                      <th>Branch</th>
                      <th>Department</th>
                      <th>Position</th>
                      
                    </tr>
                  </thead>
                    <tbody>
                    @if($training_employees->count()>0)
                     @foreach($training_employees as $employee)
                       <tr>
                           <td>{{$employee->viewEmployee->name}}</td>
                            @foreach($branches as $branch)
                             @if($branch->id == $employee->viewEmployee->branch_id)
                            <td>{{$branch->name}}</td>
                             @endif
                             @endforeach

                             @foreach($departments as $department)
                              @if($department->id == $employee->viewEmployee->dep_id)
                              <td>{{$department->name}}</td>
                              @endif
                              @endforeach

                               @foreach($positions as $position)
                              @if($position->id == $employee->viewEmployee->position_id)
                              <td>{{$position->name}}</td>
                              @endif
                              @endforeach
                       </tr>
                       

                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                  @endif
                        
                    </tbody>
           </table> 
          
       </div>    -->

</div>
@stop

@section('css')

<link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
   $("#employee_table").hide();
   $("#training").css('color', '#2a3c66'); 
   $("#training").css('border', '1px solid'); 
   $("#training").css('border-color', '#2a3c66');

   $("#employee").css('color', 'white'); 
   $("#employee").css('background-color', '#2a3c66');

   $("#training").click(function(){
       $("#training_table").show();
       $("#employee_table").hide();
       
   
       $("#training").css('color', '#2a3c66'); 
       $("#training").css('border', '1px solid'); 
       $("#training").css('border-color', '#2a3c66');
       $("#training").css('background-color', 'white');

       $("#employee").css('color', 'white'); 
       $("#employee").css('background-color', '#2a3c66'); 
   
     
   });

   $("#employee").click(function(){
       $("#training_table").hide();
       $("#employee_table").show();
       
   
       $("#employee").css('color', '#2a3c66'); 
       $("#employee").css('border', '1px solid'); 
       $("#employee").css('border-color', '#2a3c66');
       $("#employee").css('background-color', 'white');

       $("#training").css('color', 'white'); 
       $("#training").css('background-color', '#2a3c66'); 
   
     
   });

     $(document).ready(function(){

        $("#start_date").datepicker({ format: 'dd-mm-yyyy' });
        $("#end_date").datepicker({ format: 'dd-mm-yyyy' });
});

</script>
@stop