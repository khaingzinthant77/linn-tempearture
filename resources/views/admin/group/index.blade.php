
@extends('adminlte::page')

@section('title', 'Employee Group')

@section('content_header')
<h5 style="color: blue;">Employee Group</h5>
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
@can('assign-create')
 <a class="btn btn-success unicode" href="{{route('groups.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Add Employee Group</a><br>
 @endcan

  <form action="{{route('groups.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                           <label for="">Select Department</label>
                           
                           <select class="form-control" id="dep_id" name="dep_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($departmentArr as $department)
                                          <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                @endforeach
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
    <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>Department</th>
                      <th>Group A</th>
                      <th>Group B</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($departments->count()>0)
                      @foreach($departments as $i=>$dept)
                        @if($dept->groups()->count()>0)
                        <tr class="table-tr" data-url="{{route('groups.show',$dept->id)}}">
                            <td>{{ $dept->name }}</td>
                           
                             
                              <td>
                                 @foreach($dept->groups as $gp)
                                 @if($gp->group == 'A')
                                    <table>
                                        <tbody>
                                             @foreach($gp->employees as $i=>$emp)
                                                <tr >
                                                  <td style="border: none;">
                                                     @if($emp->photo == '')
                                                      <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                                                      </td>
                                                      @else
                                                       <img src="{{ asset('uploads/employeePhoto/'.$emp->photo)}}" alt="photo" width="40px" height="40px">
                                                       @endif
                                                  </td>
                                                  <td style="border: none;">{{ $emp['name'] }}</td>
                                                </tr>
                                                
                                              @endforeach
                                        </tbody>
                                      </table>
                                  @endif
                                @endforeach
                              </td>

                              <td>
                                @foreach($dept->groups as $gp)
                                   @if($gp->group == 'B')
                                      <table>
                                        <tbody>
                                             @foreach($gp->employees as $i=>$emp)
                                                <tr >
                                                  <td style="border: none;">
                                                     @if($emp->photo == '')
                                                      <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                                                      </td>
                                                      @else
                                                       <img src="{{ asset('uploads/employeePhoto/'.$emp->photo)}}" alt="photo" width="40px" height="40px">
                                                       @endif
                                                  </td>
                                                  <td style="border: none;">{{ $emp['name'] }}</td>
                                                </tr>
                                                
                                              @endforeach
                                        </tbody>
                                      </table>
                                       
                                      
                                    @endif
                                @endforeach
                              </td>

                           
                            <td>
                                <form action="{{route('groups.destroy',$dept->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('assign-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('groups.edit',$dept->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('assign-delete')
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endif
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
          // $('table').on("click", "tr.table-tr", function() {
          //   window.location = $(this).data("url");
          // });

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