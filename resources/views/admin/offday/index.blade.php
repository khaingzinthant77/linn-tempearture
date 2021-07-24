
@extends('adminlte::page')

@section('title', 'Offday')

@section('content_header')
<h5 style="color: blue;">Offday Management</h5>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:'';
  $date = isset($_GET['date'])?$_GET['date']:'';

  $year = isset($_GET['year'])?$_GET['year']:date('Y'); 
  $month = isset($_GET['month'])?$_GET['month']:date('F');  
 
?>

 <form class="form-horizontal" action="{{route('offdayimport')}}" method="POST" enctype="multipart/form-data">
          @csrf

           <div class="row form-group">
                <div class="col-md-2">
                  <input type="file" name="file" class="form-control" style="font-size: 13px">
                    @if ($errors->has('file'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-1">
                <button class="btn btn-success btn-sm"><i class="fas fa-file-csv"></i> Import</button>
                </div>
               <!-- <div class="col-md-5"></div> -->
               <div>
               <a class="btn btn-primary btn-sm"  href="{{route('offdays.download.csv')}}"><i class="fa fa-fw fa-download" ></i>Demo CSV File</a>
               </div>
               <div style="margin-left: 10px">
                 <a class="btn btn-warning btn-sm" id="export_btn" style="font-size: 13px;><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a> 
               </div>
          </div>
           
</form><br>

 <form id="excel_form" action="{{ route('offdayexport') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" id="dept_id" name="dept_id" value="{{ $dept_id }}">
</form>

<div>

    @can('offday-create')
     <a class="btn btn-success unicode" href="{{route('offday.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Offday</a>
     @endcan

      <form action="{{route('offday.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
         <div class="row form-group">
         
               <div class="col-md-2">                 
                  <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
               </div>
               <div class="col-md-2">
                       <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#myModal" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
              </div>
        
         </div>
      </form>


      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">More Filter</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
             
            </div>
            <div class="modal-body">
               <form action="{{route('offday.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
                  <div class="row form-group" id="adv_filter">
                      <div class="col-md-12">
                          <div class="row">
                              
                                 <div class="col-md-4">
                                  <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-md-4">
                                 <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                               <div class="col-md-4">
                                 <select class="form-control" id="position_id" name="position_id" style="font-size: 13px">
                                    <option value="">Select Rank</option>
                                    @foreach($ranks as $rank)
                                    <option value="{{$rank->id}}" {{ (old('position_id',$position_id)==$rank->id)?'selected':'' }}>{{$rank->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            
                            
                          </div>
                          <br>
                          <div class="row">
                              {{-- <div class="col-md-4">               
                                  <input type="text" name="date" id="date" value="{{ old('date',$date) }}" class="form-control" style="font-size: 13px" placeholder="01-01-2021">
                              </div> --}}
                              <div class="col-md-4">   
                                 <input type="text" name="month" id="month"class="form-control unicode" placeholder="June" value="{{ old('month',$month) }}" style="font-size: 13px">
                              </div>
                              <div class="col-md-4">   
                                 <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px">
                              </div>
                          </div><br>
                          <div class="row">
                             <div class="col-md-12" align="center">
                               <button type="button" class="btn btn-danger btn-sm" id="clear_search" >Clear</button>

                               <button type="submit" class="btn btn-primary btn-sm" >Search</button>
                             </div>
                          </div>
                      </div>
                     
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <div class="tab">
   <button class="tablinks" id="tbl_view" onclick="openTab(event, 'table_view')">Table View</button>
   <button class="tablinks" onclick="openTab(event, 'calendar_view')">Calendar View</button>
</div>
<div id="table_view" class="tabcontent">
    <div class="table-responsive" style="font-size:14px">
       <table class="table table-bordered styled-table">
          <thead>
             <tr>
                <th>No</th>
                <th>Image</th>
                <th>Employee Name</th>
                <th>Day Off 1</th>
                <th>Day Off 2</th>
                <th>Day Off 3</th>
                <th>Day Off 4</th>
                <th>Last Updated by</th>
                <th>Action</th>
             </tr>
          </thead>
          <tbody>
             @if($offdays->count()>0)
             @foreach($offdays as $offday)
             <tr class="table-tr" data-url="{{route('offday.show',$offday->emp_id)}}">
                <td>{{++$i}}</td>
                @if($offday->photo == '')
                <td>
                   <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                </td>
                @else
                <td>
                   <img src="{{ asset('uploads/employeePhoto/'.$offday->photo) }}" alt="photo" width="80px" height="80px">
                </td>
                @endif
                <td>{{$offday->viewEmployee->name}}<br>
                   {{$offday->department_name}}<br>
                   {{$offday->branch_name}}
                </td>
                <td>@if($offday->off_day_1!='') {{date('d-m-Y',strtotime($offday->off_day_1))}} @endif</td>
                <td>@if($offday->off_day_2!='') {{date('d-m-Y',strtotime($offday->off_day_2))}} @endif</td>
                <td>@if($offday->off_day_3!='') {{date('d-m-Y',strtotime($offday->off_day_3))}} @endif</td>
                <td>@if($offday->off_day_4!='') {{date('d-m-Y',strtotime($offday->off_day_4))}} @endif</td>
                <td>{{$offday->name}}</td>
                <td>
                   <form action="{{route('offday.destroy',$offday->id)}}" method="post"
                      onsubmit="return confirm('Do you want to delete?');">
                      @csrf
                      @method('DELETE')
                      @can('offday-edit')
                      <a class="btn btn-sm btn-primary" href="{{route('offday.edit',$offday->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                      @endcan
                      @can('offday-delete')
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
       <div class="row">
         <div class="col-md-12 text-center"><p>Total record: {{$count}}</p></div>
       </div>
       {!! $offdays->appends(request()->input())->links() !!}
    </div>
</div>
<div id="calendar_view" class="tabcontent">
   <div class="calendar" id="calendar"></div>
</div>  

@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
<link href='{{ asset("calender/fullcalendar.min.css") }}' rel='stylesheet' />
<link href='{{ asset("calender/fullcalendar.print.min.css") }}' rel='stylesheet' media='print' />
<style>
  /* Style the tab */
   .tab {
     overflow: hidden;
     border: 1px solid #ccc;
     background-color: #f1f1f1;
   }
   /* Style the buttons inside the tab */
   .tab button {
     background-color: inherit;
     float: left;
     border: none;
     outline: none;
     cursor: pointer;
     padding: 4px 6px;
     transition: 0.3s;
     font-size: 14px;
   }
   /* Change background color of buttons on hover */
   .tab button:hover {
    background-color: #ddd;
   }
   /* Create an active/current tablink class */
   .tab button.active {
    background-color: #ccc;
   }
   /* Style the tab content */
   .tabcontent {
     display: none;
     padding: 6px 12px;
     border: 1px solid #ccc;
     border-top: none;
   }
    #calendar {
        max-width: 75%;
        margin: 0 auto;
        font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        font-size: 13px;
    }
    .fc-content{
      color: white;
    }
</style>
@stop
<?php
    $arr1 = []; 
    $arr0 = [];
    foreach($emp_offday_arr as $emp_offday){
        if($emp_offday['off_day_1']!=''){
          $a = ['title'=>$emp_offday['empname'], 'start'=> $emp_offday['off_day_1'] ];
          array_push($arr1, $a);
          array_push($arr0,$a);
        }
        if($emp_offday['off_day_2']!=''){
          $a = ['title'=>$emp_offday['empname'], 'start'=> $emp_offday['off_day_2'] ];
          array_push($arr1, $a);
          array_push($arr0,$a);
        }
        if($emp_offday['off_day_3']!=''){
          $a = ['title'=>$emp_offday['empname'], 'start'=> $emp_offday['off_day_3'] ];
          array_push($arr1, $a);
          array_push($arr0,$a);
        }
        if($emp_offday['off_day_4']!=''){
          $a = ['title'=>$emp_offday['empname'], 'start'=> $emp_offday['off_day_4'] ];
          array_push($arr1, $a);
          array_push($arr0,$a);
        }
       
    }
    $date = date('Ymd')."";
?>
@section('js')
<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
<script src='{{ asset("calender/moment.min.js") }}'></script>
<script src='{{ asset("calender/fullcalendar.min.js") }}'></script>
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
             $('#export_btn').click(function(){
                    $('#excel_form').submit();
            });
            // $('#branch_id').on('change',function(e) {

            //     this.form.submit();
            // });
            // $('#dept_id').on('change',function(e) {

            //     this.form.submit();
            // });

            // $('#date').on('change',function(e) {

            //     this.form.submit();
            // });
            // 
            $("#year").datepicker({  format: "yyyy",
               viewMode: "years", 
               minViewMode: "years" 
            });
   
             $("#month").datepicker({  format: "MM",
                 viewMode: "months", 
                 minViewMode: "months" 
             });
   
        });

            $(function() {
            $(document).find("#clear_search").click(function(){
                $(document).find("select").val('');
                $(document).find("input").val('');
            });
          });

        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });

        $("#date").datepicker({ format: 'dd-mm-yyyy' });

        });

        $(document).ready(function(){
         document.getElementById("table_view").style.display = "block"; 
         $("#tbl_view").addClass("active");       
       });
  
       function openTab(evt, tabName) {
   
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            }
         
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
          $('#calendar').fullCalendar({
              defaultDate: new Date(),
              editable: true,
              eventLimit: true, // allow "more" link when too many events
              events: <?php echo json_encode($arr1); ?>
          });
      }
     </script>
@stop