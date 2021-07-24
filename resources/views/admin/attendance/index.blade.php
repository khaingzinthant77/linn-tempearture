@extends('adminlte::page')

@section('title', 'Attendance')

@section('content_header')
<h5 style="color: blue;">Attendance List</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
        $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
        $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
        $attendance_date = isset($_GET['attendance_date'])?$_GET['attendance_date']:''; 
        if ($attendance_date == '') {
          $attendance_date = date('d-m-Y');
        }
?>
<!-- <div class="row"> -->

    <form action="{{route('attendance.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row">
     
       <div class="col-md-2">   
       <label style="margin-top: 13px;"></label>              
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
        <div class="col-md-2">
          <label for="">Select Branch</label>
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
       <label style="margin-top: 13px;"></label>              
          <input type="text" name="attendance_date" id="attendance_date" value="{{ old('attendance_date',$attendance_date) }}" class="form-control" style="font-size: 13px">
        </div>
     </div>
      </form>
<!-- </div> -->
 
@can('attendance-create')
   <a class="btn btn-success unicode" href="{{route('attendance.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>
@endcan

      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                       <th>Image</th>
                        <th>Employee Name</th>
                        <th>Branch</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Time In</th>
                        <th>Time In Date</th>
                        <th>Time Out</th>
                        <th>Time Out Date</th>
                        <th>Location</th>
                        <th>Attendance Status</th>
                        <th>Last Updated by</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($attendances->count()>0)
              		 @foreach($attendances as $attendance)

                        <tr class="table-tr" data-url="{{route('attendance.show',$attendance->id)}}">
                          <td>{{++$i}}</td>
                           
                            @if($attendance->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$attendance->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$attendance->employee->name}}</td>
                            <td>{{$attendance->branch_name}}</td> 
                            <td>{{$attendance->dept_name}}</td>
                            <td>{{$attendance->position_name}}</td>
                            <td>
                              @if($attendance->clock_in!='')
                              {{ date('h:i A', strtotime($attendance->clock_in))}}
                              @endif
                            </td>
                            <td>{{date('d-m-Y',strtotime($attendance->date))}}</td>
                            <td>
                              @if($attendance->clock_out)
                              {{date('h:i A', strtotime($attendance->clock_out))}}
                              @endif
                            </td>
                            @if($attendance->out_date != null)
                            <td>{{date('d-m-Y',strtotime($attendance->out_date))}}</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{$attendance->clockin_ip_address}}</td>

                            @if($attendance->attendance_status == 1)
                            <td>Present</td>
                            @elseif($attendance->attendance_status == 2)
                            <td>Absent</td>
                            @elseif($attendance->attendance_status == 3)
                            <td>Leave</td>
                            @endif
                            @if($attendance->last_updated_user != null)
                            <td>{{$attendance->last_updated_user->name}}</td>
                            @else
                            <td></td>
                            @endif
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                        @endif
			            
                    </tbody>
           </table> 
           {!! $attendances->appends(request()->input())->links() !!}
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

            $('#attendance_date').on('change',function(e) {

                this.form.submit();
            });
   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });
          $("#attendance_date").datepicker({ format: 'dd-mm-yyyy' });
        });


     </script>
@stop