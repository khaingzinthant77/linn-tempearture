@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<style>
.add {
  background-color:#AA55AA;
  border: none;
  color: white;
  padding: 2px 20px;
  font-size: 30px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.add:hover {
  background-color: #FF55FF;
}
.input-group.md-form.form-sm.form-1 input{
border: 1px solid purple;
border-top-right-radius: 0.25rem;
border-bottom-right-radius: 0.25rem;
}
.input-group-text{
background-color:#AA55AA;
color:white;
}
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 22px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 2px;
  bottom: 0px;
  top:3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 36px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<h5 style="color: blue;">Branch Management</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>

@can('branch-create')
   <a class="btn btn-success unicode" href="{{route('branch.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Branch</a>
   @endcan


     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

      <form action="{{route('branch.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
      </form>

      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Branch Name</th>
                        <th>Phone</th>
                        <th>Employees</th>
                        <th>Active/Inactive</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($branchs->count()>0)
              		 @foreach($branchs as $branch)

                        <tr class="table-tr" data-url="{{  url('employee?branch_id='.$branch->id) }}">
                            <td>{{++$i}}</td>
                            <td>{{$branch->name}}</td>
                            <td>{{$branch->phone}}</td>
                            <td>{{ $branch->employees()->count() }}</td>
                            <td>
                              <label class="switch">
                                  <input data-id="{{$branch->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $branch->status ? 'checked' : '' }}>
                                  <span class="slider round"></span>
                              </label>
                            </td>
                            <td>
                                <form action="{{route('branch.destroy',$branch->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-info" href="{{url('employee?branch_id='.$branch->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                    @can('branch-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('branch.edit',$branch->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('branch-delete')
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
           {!! $branchs->appends(request()->input())->links() !!}
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
          });

        });

        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0; 
                var branch_id = $(this).data('id'); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("change-status-active")) ?>",
                    data: {'status': status, 'branch_id': branch_id},
                    success: function(data){
                     console.log(data.success);
                    }
                });
            })
          });

     </script>
@stop