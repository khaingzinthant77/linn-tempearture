@extends('adminlte::page')

@section('title', 'KPI')

@section('content_header')

@php
$kpiArr = ['Poor','Bad','Average','Good','Excellent'];
$colorArr = ['#FC0107','#FD8008','#0576f4','#00A825','#21FF06'];
@endphp

<div class="row">
  <div class="col-md-2">
    <h5 style="color: blue;">KPI</h5>
  </div>
  <div class="col-md-10 text-right">
  @foreach($kpiArr as $i=>$label)

    <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;"> {{++$i}} = {{ $label }}</button>&nbsp;&nbsp;&nbsp;
  @endforeach
  </div>
</div>
<br>
@stop
@section('content')
<?php
  $name = isset($_GET['name'])?$_GET['name']:'';
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:'';
  $dept_id = isset($_GET['dept_id'])?$_GET['dept_id']:'';
  $year = isset($_GET['year'])?$_GET['year']:'';
  $month = isset($_GET['month'])?$_GET['month']:'';
  $kpi = isset($_GET['kpi'])?$_GET['kpi']:'';
  $point = isset($_GET['point'])?$_GET['point']:'';
  $order = isset($_GET['order'])?$_GET['order']:'';
?>
   
<form class="form-horizontal" action="{{route('kpiimport')}}" method="POST" enctype="multipart/form-data">
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
           
           <div>
           <a class="btn btn-primary btn-sm"  href="{{route('kpis.download.csv')}}"><i class="fa fa-fw fa-download" ></i>Demo CSV File</a>

           </div>
          

           <div style="margin-left: 10px">
           
             <a class="btn btn-warning btn-sm" id="export_btn" style="font-size: 13px;><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a> 
             
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
             <form action="{{route('kpi.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
                <div class="row form-group" id="adv_filter">
                    <div class="col-md-12">
                        <div class="row">
                            
                            <div class="col-md-3">
                                <label for="">Select Branch</label>
                                 <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                        @endforeach
                                      </select>
                            </div>
                            <div class="col-md-3">
                               <label for="">Select Department</label>
                               
                               <select class="form-control" id="dept_id" name="dept_id" style="font-size: 13px">
                                      <option value="">Select Department</option>
                                      @foreach($departments as $department)
                                      <option value="{{$department->id}}" {{ (old('dept_id',$dept_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                      @endforeach
                                  </select>
                            </div>

                            <div class="col-md-3">
                               <label for="">Month</label>
                               
                                <input type="text" name="month" id="month"class="form-control unicode" placeholder="June" value="{{ old('month',$month) }}" style="font-size: 13px">
                            </div>

                             <div class="col-md-3">
                               <label for="">Year</label>
                               
                               
                                   <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px">
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                             <label for="">Select KPI</label> 
                              <select class="form-control" id="kpi" name="kpi" style="font-size: 13px">
                                  <option value="">Select KPI</option> 
                                  <option value="knowledge" {{ ($kpi==='knowledge')?'selected':'' }}>Knowledge</option>
                                  <option value="descipline" {{ ($kpi==='descipline')?'selected':'' }}>Discipline</option> 
                                  <option value="skill_set" {{ ($kpi==='skill_set')?'selected':'' }}>Skill Set</option>
                                  <option value="team_work" {{ ($kpi==='team_work')?'selected':'' }}>Team Work</option> 
                                  <option value="social" {{ ($kpi==='social')?'selected':'' }}>Social</option>    
                                  <option value="motivation" {{ ($kpi==='motivation')?'selected':'' }}>Motivation</option>     
                              </select>
                          </div>
                          <div class="col-md-3">
                             <label for="">Max/Min</label> 
                              <select class="form-control" id="point" name="point" style="font-size: 13px">
                                  <option value="">Select Point</option> 
                                  <option value="1" {{ ($point==1)?'selected':'' }}>Poor</option>
                                  <option value="2" {{ ($point==2)?'selected':'' }}>Bad</option> 
                                  <option value="3" {{ ($point==3)?'selected':'' }}>Average</option>
                                  <option value="4" {{ ($point==4)?'selected':'' }}>Good</option> 
                                  <option value="5" {{ ($point==5)?'selected':'' }}>Excellent</option>     
                              </select>
                          </div>

                           <div class="col-md-3">
                             <label for="">Order By Points</label> 
                              <select class="form-control" id="order" name="order" style="font-size: 13px">
                                  <option value="">Select Order</option> 
                                  <option value="desc" {{ ($order=='desc')?'selected':'' }}>Highest</option>
                                  <option value="asc" {{ ($order=='asc')?'selected':'' }}>Lowest</option>    
                              </select>
                          </div>

                        </div>
                        <br>
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

         <form action="{{route('kpi.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
             <div class="row form-group">
             
               <div class="col-md-2">                 
                  <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
                </div>

                 <div class="col-md-2">
                 <!-- Trigger the modal with a button -->
                  <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#myModal" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
                 </div>
                 
                 <div class="col-md-8" align="right">
                  @can('kpi-create')
                <a class="btn btn-success unicode" href="{{route('kpi.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> &nbsp;Add KPI</a>
                @endcan
              </div>
               
             </div>
        </form>

          <form id="excel_form" action="{{ route('kpiexport') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" id="dept_id" name="dept_id" value="{{ $dept_id }}">
                <input type="hidden" name="month" id="month"class="form-control unicode" value="{{ old('month',$month) }}" >

                 <input type="hidden" name="year" id="year"class="form-control unicode" value="{{ old('year',$year) }}">
         </form>


    <br>
    <div class="row">
      <div class="col-md-2">
        <p style="padding-left: 10px">Total record:{{$count}}</p>
      </div>
      <div class="col-md-10 text-right">
             <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-eye-slash"></i>
                <span class="caret"></span></button>
                <ul class="dropdown-menu" id="grpChkBox">
                  <li class="list-group-item clickable toggle-table-column">
                    <input type="checkbox" checked="checked" name="date" /> &nbsp;Date&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="photo" /> &nbsp;Photo&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="empname" /> &nbsp;Name&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column">
                    <input type="checkbox" checked="checked" name="knowledge" /> &nbsp;Knowledge&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="discipline" /> &nbsp;Discipline&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                     <input type="checkbox" checked="checked" name="skill_set" /> &nbsp;Team Work&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                     <input type="checkbox" checked="checked" name="team_work" /> &nbsp;Skill Set&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column">
                      <input type="checkbox" checked="checked" name="social" /> &nbsp;Social&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="motivation" /> &nbsp;Motivation&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="total" /> &nbsp;Total Point&nbsp;&nbsp;
                  </li>
                   <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="action" /> &nbsp;Action&nbsp;&nbsp;
                  </li>
                </ul>
              </div>
       </div> 
      
    </div>
    <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table" id="kpiTabble">
                  <thead>
                    <tr> 
                      <th class="no">No</th>
                      <th class="date">Date</th>
                      <th class="photo">Photo</th>
                      <th class="empname">Name</th>
                      <th class="knowledge">Knowledge</th>
                      <th class="discipline">Discipline</th>
                      <th class="skill_set">Skill Set</th>
                      <th class="team_work">Team Work</th>
                      <th class="social">Social</th>
                      <th class="motivation">Motivation</th>
                      <th class="total">Total Point</th>
                      <th class="action">Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($kpis->count()>0)
              		    @foreach($kpis as $kpi)

                        @php
                          $totalpoint = 0;
                          $totalpoint = $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation; 
                        @endphp

                        <tr class="table-tr" data-url="{{route('kpi.show',$kpi->id)}}">
                          <td class="no">{{++$no}}</td>
                          @php 
                            $date = $kpi->year .'-'. $kpi->month;
                          @endphp
                          <td class="date">{{ date('M Y',strtotime($date)) }}</td>
                          <td align="center" class="photo">
                              @if($kpi->employee->photo == '')
                                <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="60px" height="60px">
                              @else
                                <img src="{{ asset('uploads/employeePhoto/'.$kpi->employee->photo) }}" alt="photo" width="60px" height="60px">
                              @endif
                          </td>
                          <td class="empname">
                            {{ $kpi->employee->name}} <br>
                            {{ $kpi->employee->viewDepartment->name}} <br>
                            {{ $kpi->employee->viewPosition->name}}
                          </td>
                            <td class="knowledge"> 
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->knowledge)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="discipline">
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->descipline)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="skill_set">
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->skill_set)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="team_work">
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->team_work)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="social">
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->social)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="motivation">
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->motivation)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td class="total" style="text-align: right;">{{ $totalpoint }}</td>
                            <td class="action">
                              <form action="{{route('kpi.destroy',$kpi->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                    @csrf
                                    @method('DELETE')
                                    @can('kpi-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('kpi.edit',$kpi->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('kpi-delete')
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
          
           {!! $kpis->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
 <script> 

    $(function () {
      var $chk = $("#grpChkBox input:checkbox"); 
      var $tbl = $("#kpiTabble");
      var $tblhead = $("#kpiTabble th");
   
      $chk.prop('checked', true); 
   
      $chk.click(function () {
          var colToHide = $tblhead.filter("." + $(this).attr("name"));
          var index = $(colToHide).index();
          $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
      });
    });
       
         

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
            //  $('#branch_id').on('change',function(e) {

            //     this.form.submit();
            // });
            // $('#dept_id').on('change',function(e) {

            //     this.form.submit();
            // });
            //  $('#year').on('change',function(e) {
            //     this.form.submit();
            // });

            //   $('#month').on('change',function(e) {
            //     this.form.submit();
            // });
   
        });
          $(function() {
            $('table').on("click", "tr.table-tr", function() {
              window.location = $(this).data("url");
            });
            });
              $("#year").datepicker({  format: "yyyy",
              viewMode: "years", 
              minViewMode: "years" }); 

               $("#month").datepicker({  format: "MM",
              viewMode: "months", 
              minViewMode: "months" });

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

          $(function() {
            $(document).find("#clear_search").click(function(){
                $(document).find("select").val('');
                $(document).find("input").val('');
            });
          });

     </script>
@stop