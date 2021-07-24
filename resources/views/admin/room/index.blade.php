
@extends('adminlte::page')

@section('title', 'Room')

@section('content_header')
<h5 style="color: blue;">Room Management</h5>
@stop
@section('content')

<div>

@can('room-create')
 <a class="btn btn-success unicode" href="{{route('room.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Room</a>
 @endcan
 
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
                        <th>Hostel Name</th>
                        <th>Room No</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($rooms->count()>0)
                     @foreach($rooms as $room)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$room->viewHostel->name}}</td>
                            <td>{{$room->room_no}}</td>
                            <td>
                                <form action="{{route('room.destroy',$room->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                   @can('room-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('room.edit',$room->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('room-delete')
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
           {!! $rooms->appends(request()->input())->links() !!}
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