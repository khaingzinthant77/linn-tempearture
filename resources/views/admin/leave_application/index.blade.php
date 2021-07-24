@extends('adminlte::page')

@section('title', 'Leave Application')

@section('content_header')
<h5 style="color: blue;">Leave Application</h5>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  $application_status = isset($_GET['application_status'])?$_GET['application_status']:'';
  $date = isset($_GET['date'])?$_GET['date']:''; 
  if ($date == '') {
    $date = date('d-m-Y');
  }
?>
<!-- <div class="row"> -->
    <form action="{{route('leave_application.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row">
     
       <div class="col-md-2">   
       <label style="margin-top: 13px;"></label>              
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
        <div class="col-md-2">
          <label>Select Branch</label>
           <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
              <option value="">All</option>
              @foreach($branches as $branch)
              <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">
          <label for="">Select Department</label>
        <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
              <option value="">All</option>
              @foreach($departments as $department)
              <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
              @endforeach
          </select>
      </div>
        <div class="col-md-2">
          <label for="">Select Application Status</label>
          <select class="form-control" id="application_status" name="application_status" style="font-size: 13px">
                <option value="">All</option>  
                <option value="0" {{ (old('application_status',$application_status)=="0")?'selected':'' }}>Pending</option>
                <option value="1" {{ (old('application_status',$application_status)=="1")?'selected':'' }}>Approved</option>
                <option value="2" {{ (old('application_status',$application_status)=="2")?'selected':'' }}>Rejected</option>
               </select>
      </div>
      <div class="col-md-2">  
        <label for="">Date</label>             
        <input type="text" name="date" id="date" value="{{ old('date',$date) }}" class="form-control" style="font-size: 13px">
       </div>
      
     </div> 
      </form>
<!-- </div> -->
 
 @can('leave-list')

   <a class="btn btn-success unicode" href="{{route('leave_application.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>

  @endcan
      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Image</th>
                        <th>Employee Name</th>
                        <th>Leave Type</th>
                        <th>Half Day Type</th>
                        <th>Apply Date</th>
                        <th>Day</th>
                        <th>Reason</th>
                        <th>Application Status</th>
                        <th>Last Updated by</th>
                    </tr>
                  </thead>
                    <tbody>

                    @if($leave_applications->count()>0)
              		 @foreach($leave_applications as $leave_application)

                        <tr class="table-tr" data-url="{{route('leave_application.show',$leave_application->id)}}">
                          <td>{{++$i}}</td>
                           
                            @if($leave_application->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$leave_application->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>
                              {{$leave_application->employee->name}}<br>
                              {{$leave_application->branch_name}}<br>
                              {{$leave_application->dept_name}}
                            </td>
                            <td>{{$leave_application->leave_type}}</td> 
                            @if($leave_application->halforfull == 0)
                            <td>Full Day</td>
                            @elseif($leave_application->halforfull == 1)
                            <td>Half Day</td>
                            @endif
                            <td>{{date('d-m-Y',strtotime($leave_application->apply_date))}}</td>
                            <td>{{$leave_application->days}}</td>
                            <td>{{$leave_application->reason}}</td>
                            @if($leave_application->application_status == 0)
                            <td>Pending</td>
                            @elseif($leave_application->application_status == 1)
                            <td>Approved</td>
                            @else
                            <td>Rejected</td>
                            @endif
                            <td>{{$leave_application->name}}</td>
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                        @endif
			            
                    </tbody>
           </table> 
           {!! $leave_applications->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
 <script> 
      @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
        $(document).ready(function(){
            setTimeout(function(){
            $("div.alert").remove();
            }, 1000 ); 
            $(function() {
                $('#name').on('change',function(e) {

                this.form.submit();
            }); 
            $('#branch_id').on('change',function(e) {

                this.form.submit();
            });
            $('#dept_id').on('change',function(e) {
                this.form.submit();
            });

            $('#date').on('change',function(e) {
                this.form.submit();
            });
            $('#attendance_date').on('change',function(e){
              this.form.submit();
            })
        $("#attendance_date").datepicker({ format: 'dd-mm-yyyy' });
        });
        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });

        $("#date").datepicker({ format: 'dd-mm-yyyy' });

        });


     </script>
@stop