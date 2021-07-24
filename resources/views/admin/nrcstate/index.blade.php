
@extends('adminlte::page')

@section('title', 'NRC State')

@section('content_header')
<h5 style="color: blue;">NRC State Management</h5>
@stop
@section('content')
<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>
@can('nrc-state-create')
  <a class="btn btn-success unicode" href="{{route('nrcstate.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> NRCState</a>
  @endcan
  
      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

      <form action="{{route('nrcstate.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      
       <div class="col-md-3">                 
          <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px"> 
        </div>
     </div>
    </form>
    <p>Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Nrc Code</th>
                        <th>Nrc State</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                	 @if($nrcstates->count()>0)
              		 @foreach($nrcstates as $nrcstate)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$nrcstate->viewCode->name}}</td>
                            <td>{{$nrcstate->name}}</td>
                            <td>
                                <form action="{{route('nrcstate.destroy',$nrcstate->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('nrc-state-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('nrcstate.edit',$nrcstate->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('nrc-state-delete')
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
           {!! $nrcstates->appends(request()->input())->links() !!}
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