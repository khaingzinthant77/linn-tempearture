@extends('adminlte::page')

@section('title', 'Leave Type')

@section('content_header')
<h5 style="color: blue;">Leave Type</h5>
@stop
@section('content')



   <a class="btn btn-success unicode" href="{{route('leave_type.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i>Add New!!!</a><br>


      <p style="padding-left: 10px">Total record:{{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Leave Type</th>
                        <th>Number of Leave</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($leave_types->count()>0)
              		 @foreach($leave_types as $leave_type)

                        <tr class="table-tr" data-url="{{route('leave_type.show',$leave_type->id)}}">
                          <td>{{++$i}}</td>
                            <td>{{$leave_type->leave_type}}</td>
                            <td>{{$leave_type->num_of_leave}}</td>
                            
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                        @endif
			            
                    </tbody>
           </table> 
           {!! $leave_types->appends(request()->input())->links() !!}
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