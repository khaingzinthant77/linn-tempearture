@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<h5 style="color: blue;">Actual Time In</h5>
@stop
@section('content')


  @if($actual_timeins->count()< 1)
   <a class="btn btn-success unicode" href="{{route('actual_timein.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>
   @endif

      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <!-- <th>No</th> -->
                        <th>Actual Time In</th>
                        <!-- <th>Phone</th>
                        <th>Employees</th>
                        <th>Active/Inactive</th> -->
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($actual_timeins->count()>0)
              		 @foreach($actual_timeins as $actual_timein)

                        <tr class="table-tr">
                            <td>{{$actual_timein->actual_timein}}</td>
                           
                            <td>
                                <form action="{{route('actual_timein.destroy',$actual_timein->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                    <a class="btn btn-sm btn-primary" href="{{route('actual_timein.edit',$actual_timein->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
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
           {!! $actual_timeins->appends(request()->input())->links() !!}
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