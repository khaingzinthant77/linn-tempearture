@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<h5 style="color: blue;">Award</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
        $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
        $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
?>
<!-- <div class="row"> -->
    <form action="{{route('award.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
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
     </div>
      </form>
<!-- </div> -->
 
@can('award-create')
   <a class="btn btn-success unicode" href="{{route('award.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>

@endcan
      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Employee Name</th>
                        <th>Image</th>
                        <th>Award Name</th>
                        <th>Gift</th>
                        <th>Cash Price</th>
                        <th>Month</th>
                        <th>Year</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($awards->count()>0)
              		 @foreach($awards as $award)

                        <tr class="table-tr" data-url="{{route('award.show',$award->id)}}">
                          <td>{{++$i}}</td>
                            <td>{{$award->employee->name}}</td>
                            @if($award->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$award->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$award->award_name}}</td> 
                            <td>{{$award->gift}}</td>
                            <td>{{$award->cash_price}}</td>
                            <td>{{$award->month}}</td>
                            <td>{{$award->year}}</td>
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                        @endif
			            
                    </tbody>
           </table> 
           {!! $awards->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')

@stop

@section('js')
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

        });


     </script>
@stop