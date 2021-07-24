
@extends('adminlte::page')

@section('title', 'Position')

@section('content_header')
<h5 style="color: blue;">Rank Management</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>

  @can('rank-create')
     <a class="btn btn-success unicode" href="{{route('position.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Position</a>
     @endcan
  
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

      <form action="{{route('position.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
     
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
        </div>
     </div>
    </form>
  <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Rank Name</th>
                        <th>Employees</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($positions->count()>0)
              		 @foreach($positions as $position)
                        <tr class="table-tr" data-url="{{  url('employee?position_id='.$position->id) }}">
                            <td>{{++$i}}</td>
                            <td>{{$position->name}}</td>
                            <td>{{ $position->employees()->count() }}</td>
                            <td>
                                <form action="{{route('position.destroy',$position->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('rank-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('position.edit',$position->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('rank-delete')
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
            {!! $positions->appends(request()->input())->links() !!}
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