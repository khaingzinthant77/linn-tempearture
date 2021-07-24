
@extends('adminlte::page')

@section('title', 'RO')

@section('content_header')
<h5 style="color: blue;">RO Management</h5>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
?>
  <form action="{{route('ro.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
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

                 <div class="col-md-6" align="right">
                @can('ro-create')
                <a class="btn btn-success unicode" href="{{route('ro.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Ro</a>
                @endcan
              </div>
               
             </div>
        </form><br>

<div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                       <th>Branch</th>
                      <th>Department</th>
                      <th>Ro</th>
                      <th>Member</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($office_reporters->count()>0)
                      @foreach($office_reporters as $office_reporter)
                        <tr>
                          <td>{{$office_reporter->branch_name}}</td>
                          <td>{{$office_reporter->department}}</td>
                          <td>
                             @if($office_reporter->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" width="40px" height="40px">
                                </td>
                                @else
                                 <img src="{{ asset('uploads/employeePhoto/'.$office_reporter->photo)}}" width="40px" height="40px">
                                 @endif 
                            {{$office_reporter->ro_name}}
                          </td>
                         
                          <td>
                            
                          @foreach($ro_members as $ro_member)
                          @if($ro_member->ro_id == $office_reporter->id)
                            @if($ro_member->members->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" width="40px" height="40px" style="margin-top: 10px">
                                </td>
                                @else
                                 <img src="{{ asset('uploads/employeePhoto/'.$ro_member->members->photo)}}" width="40px" height="40px" style="margin-top: 10px">
                                 @endif
                            {{$ro_member->members->name}}<br>
                           @endif
                          @endforeach
                          
                        </td>
                        <td>
                                <form action="{{route('ro.destroy',$office_reporter->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    @can('ro-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('ro.edit',$office_reporter->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('ro-delete')
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