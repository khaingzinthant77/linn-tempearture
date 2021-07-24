
@extends('adminlte::page')

@section('title', 'Hostel Employee')

@section('content_header')
<h5 style="color: blue;">Hostel Employee Management</h5>
@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:'';
  $hostel_id = isset($_GET['hostel_id'])?$_GET['hostel_id']:'';

  ?>

<div>

@can('hostel-employee-create')
 <a class="btn btn-success unicode" href="{{route('hostelemployee.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Hostel Employee</a>
 @endcan<br>

  <form action="{{route('hostelemployee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="unicode">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
                        </div> 
                         <div class="col-md-2">
                            <label for="">Select Hostel</label>
                           <select class="form-control" id="hostel_id" name="hostel_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($hostels as $hostel)
                                <option value="{{$hostel->id}}" {{ (old('hostel_id',$hostel_id)==$hostel->id)?'selected':'' }}>{{$hostel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Select Branch</label>
                           <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                           <label for="">Select Department</label>
                           
                         <select class="form-control" id="dep_id" name="dep_id" style="font-size: 13px">
                              <option value="">All</option>
                                    @foreach($departments as $department)
                                              <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
                          </select>
                                  
                          </select>
                        </div>
                        <div class="col-md-2">
                             <label for="">Select Rank</label>
                             <select class="form-control" id="position_id" name="position_id" style="font-size: 13px">
                            <option value="">All</option>
                               @foreach($positions as $position)
                                                <option value="{{$position->id}}" {{ (old('position_id',$position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
                                @endforeach
                       
                             </select>
                       
                             </select>
                        </div>

                    
                      
                    </div>
                </div>
               
            </div>
        </form>

 
     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

     <!--  -->
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                       <th>Image</th>
                        <th>Employee Name</th>
                        <th>Hostel Name</th>
                        <th>Room No</th>
                        <th>Start Date</th>
                        <th>Full Address</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($hostelemployees->count()>0)
                     @foreach($hostelemployees as $hostelemployee)
                        <tr class="table-tr" data-url="{{route('employee.show',$hostelemployee->emp_id)}}">

                            <td>{{++$i}}</td>
                            @if($hostelemployee->viewEmployee->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/employeePhoto/'.$hostelemployee->viewEmployee->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                              <td>{{$hostelemployee->viewEmployee->name}}</td>
                            <td>{{$hostelemployee->viewHostel->name}}</td>
                            <td>{{$hostelemployee->viewRoom->room_no}}</td>
                            <td>{{date('d-m-Y',strtotime($hostelemployee->start_date))}}</td>
                            <td>{{$hostelemployee->full_address}}</td>
                            <td>
                                <form action="{{route('hostelemployee.destroy',$hostelemployee->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('hostel-employee-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('hostelemployee.edit',$hostelemployee->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('hostel-employee-delete')
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
           {!! $hostelemployees->appends(request()->input())->links() !!}
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
   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
            $('#name').on('change',function(e) {
                this.form.submit();
            }); 
              $('#branch_id').on('change',function(e){
                this.form.submit();
              });
              $('#dep_id').on('change',function(e){
                this.form.submit();
              });
              
              $('#position_id').on('change',function(e){
                this.form.submit();
              });

               $('#hostel_id').on('change',function(e){
                this.form.submit();
              });
        });
         
        });
     </script>
@stop