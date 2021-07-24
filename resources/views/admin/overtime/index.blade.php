
@extends('adminlte::page')

@section('title', 'Overtime')

@section('content_header')
<h5 style="color: blue;">Overtime Management</h5>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  $date = isset($_GET['date'])?$_GET['date']:''; 
  if ($date == '') {
    $date = date('d-m-Y');
  }
?>
<div>
@can('overtime-create')
     <a class="btn btn-success unicode" href="{{route('overtime.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Overtime</a>
     @endcan
  
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('overtime.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-2">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
        <div class="col-md-2">
            <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
              <option value="">Select Branch</option>
              @foreach($branches as $branch)
              <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">
           <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
              <option value="">Select Department</option>
              @foreach($departments as $department)
              <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
              @endforeach
          </select>
        </div>
        <div class="col-md-2">               
            <input type="text" name="date" id="date" value="{{ old('date',$date) }}" class="form-control" style="font-size: 13px">
        </div>
     </div>
    </form>
    
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Image</th>
                        <th>Employee Name</th>
                        <th>Apply Date</th>
                        <th>Reason</th>
                        <th>Overtime Staus</th>
                        <th>Approved Reason</th>
                        <th>Last Updated by</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                  @if($overtimes->count()>0)
                   @foreach($overtimes as $overtime)
                        <tr class="table-tr" >
                            <td>{{++$i}}</td>
                            @if($overtime->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$overtime->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$overtime->viewEmployee->name}}<br>
                              {{$overtime->department_name}}<br>
                              {{$overtime->branch_name}}</td>
                            <td>{{date('d-m-Y',strtotime($overtime->apply_date))}}</td>
                            <td>{{$overtime->reason}}</td>
                            @if($overtime->overtime_status == 0)
                            <td>Pending</td>
                            @elseif($overtime->overtime_status == 1)
                            <td>Approved</td>
                            @else
                            <td>Rejected</td>
                            @endif
                           <td>{{$overtime->overtime_reason}}</td>
                          <td>{{$overtime->name}}</td>
                           
                            <td>
                                <form action="{{route('overtime.destroy',$overtime->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('overtime-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('overtime.edit',$overtime->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('overtime-delete')
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                          @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                          @endif
                       
			            
                    </tbody>
           </table> 
            {!! $overtimes->appends(request()->input())->links() !!}
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
   
        });
        
        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            // window.location = $(this).data("url");
          });
        });
         $("#date").datepicker({ format: 'dd-mm-yyyy' }); 
         
        });
     </script>
@stop