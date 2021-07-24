
@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
<h5 style="color: blue;">Hostel Management</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>

@can('hostel-create')
 <a class="btn btn-success unicode" href="{{route('hostel.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Hostel</a>
 @endcan
 
     {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div> 
      @endif --}}

      <form action="{{route('hostel.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
    </form>
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Full Address</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($hostels->count()>0)
              		 @foreach($hostels as $hostel)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$hostel->name}}</td>
                            @if($hostel->photo == '')
                            <td>
                            <img src="{{ asset('uploads/images/download.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset($hostel->path.'/'.$hostel->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td>{{$hostel->full_address}}</td>
                            <td>
                                <form action="{{route('hostel.destroy',$hostel->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('hostel-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('hostel.edit',$hostel->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('hostel-delete')
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
           {!! $hostels->appends(request()->input())->links() !!}
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
     </script>
@stop