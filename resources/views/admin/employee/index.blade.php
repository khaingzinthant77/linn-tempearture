

@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
 <h5 style="color: blue;" class="unicode">Employee Management</h5>
 <style type="text/css">
     .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
    position: absolute;
    top: 2px;
    right: 0px;
    left: 270px;
    width: 100px; }
</style>

@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $branch_id = isset($_GET['branch_id'])?$_GET['branch_id']:''; 
  $dep_id = isset($_GET['dep_id'])?$_GET['dep_id']:''; 
  $position_id = isset($_GET['position_id'])?$_GET['position_id']:'';
  $gender = isset($_GET['gender'])?$_GET['gender']:''; 
  $hostel = isset($_GET['hostel'])?$_GET['hostel']:''; 
  $join_date = isset($_GET['join_date'])?$_GET['join_date']:'';
  $join_month = isset($_GET['join_month'])?$_GET['join_month']:'';
  $sy_from = isset($_GET['sy_from'])?$_GET['sy_from']:'';
  $sy_to = isset($_GET['sy_to'])?$_GET['sy_to']:'';
  $age_from = isset($_GET['age_from'])?$_GET['age_from']:'';
  $age_to = isset($_GET['age_to'])?$_GET['age_to']:'';

  $active = isset($_GET['active'])?$_GET['active']:'';
  $emp_type = isset($_GET['emp_type'])?$_GET['emp_type']:'';
  
  ?>

  

        <form class="form-horizontal unicode" action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <input type="file" name="file" class="form-control" style="font-size: 13px">
                           <!--  @if ($errors->has('file'))
                                <span style="border-color: red">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif -->
                        </div>
                        
                        <button class="btn btn-success btn-sm" style="margin-right: 10px;font-size: 13px"><i class="fas fa-file-csv" ></i> Import CSV</button>
                       
                        <a class="btn btn-primary btn-sm"  href="{{ route('employees.download.csv') }}" style="margin-right: 10px;font-size: 13px"><i class="fa fa-fw fa-download" style="padding-top: 8px" ></i>Demo CSV File</a>
                       
                      
                        <a class="btn btn-warning btn-sm" id="export_btn" style="margin-right: 10px;font-size: 13px"><i class="fa fa-fw fa-file-excel" style="padding-top: 8px"></i>Export</a>

                        {{--  <button type="button" class="btn btn-warning " id="morefilter" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                       <div class="col-md-6">
                        {{-- <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Employee</a> --}}
                        </div>
                     
                    
                    </div>
        </form><br>
   


        
        <br>

         <form id="excel_form" action="{{ route('export') }}"  method="POST" class="unicode">
                @csrf
                @method('post')
                <input type="hidden" id="branch_id" name="branch_id" value="{{ $branch_id }}">
                <input type="hidden" id="dep_id" name="dep_id" value="{{ $dep_id }}">
                <input type="hidden" id="position_id" name="position_id" value="{{ $position_id }}">
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
         <form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        
                        <div class="col-md-3">
                            <label for="">Select Branch</label>
                          <select class="form-control" id="branch_id" name="branch_id" style="font-size: 13px">
                                <option value="">All</option>
                                @foreach($branchs as $branch)
                                <option value="{{$branch->id}}" {{ (old('branch_id',$branch_id)==$branch->id)?'selected':'' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                           <label for="">Select Department</label>
                           
                          <!--   <select class="livesearch form-control" name="dep_id"  id="dep_id">
                              @foreach($departments as $department)
                                  <option value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                            </select> -->
                            <select class="form-control" id="dep_id" name="dep_id" style="font-size: 13px">
                              <option value="">All</option>
                                    @foreach($departments as $department)
                                              <option value="{{$department->id}}" {{ (old('dep_id',$dep_id)==$department->id)?'selected':'' }}>{{$department->name}}</option>
                                    @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                             <label for="">Select Rank</label>
                            <select class="form-control" id="position_id" name="position_id" style="font-size: 13px">
                            <option value="">All</option>
                               @foreach($positions as $position)
                                                <option value="{{$position->id}}" {{ (old('position_id',$position_id)==$position->id)?'selected':'' }}>{{$position->name}}</option>
                                @endforeach
                       
                             </select>
                        </div>

                        <div class="col-md-3">
                             <label for="">Select Gender</label>
                            <select class="form-control" id="gender" name="gender" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="Male" {{ (old('gender',$gender)=="Male")?'selected':'' }}>Male</option>
                              <option value="Female" {{ (old('gender',$gender)=="Female")?'selected':'' }}>Female</option>
                             </select>
                        </div>  
                      
                    </div>
                    <br>
                     <div class="row">

                        <div class="col-md-3">
                             <label for="">Hostel/No Hostel</label>
                            <select class="form-control" id="hostel" name="hostel" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="No" {{ (old('hostel',$hostel)=="No")?'selected':'' }}>No Hostel</option>
                              <option value="Yes" {{ (old('hostel',$hostel)=="Yes")?'selected':'' }}>Hostel</option>
                             </select>
                        </div>
                        

                        <div class="col-md-3">
                            <label>Join From Date</label>
                             <input type="text" name="join_date" id="join_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('join_date',$join_date) }}" style="font-size: 13px">
                        </div>

                         <div class="col-md-3">
                            <label>Join To Date</label>
                             <input type="text" name="join_month" id="join_month"class="form-control unicode" placeholder="01-02-2021" value="{{ old('join_month',$join_month) }}" style="font-size: 13px">
                        </div>

                        <div class="col-md-3">
                             <label for="">Active/Inactive</label>
                            <select class="form-control" id="active" name="active" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="1" {{ (old('hostel',$hostel)=="1")?'selected':'' }}>Active</option>
                              <option value="0" {{ (old('hostel',$hostel)=="0")?'selected':'' }}>Inactive</option>
                             </select>
                        </div>
                      </div>


                    <br>
                    <div class="row">
                      <div class="col-md-3">
                           <label for="">Service Year From</label>
                           <input type="number" name="sy_from" id="sy_from" class="form-control" placeholder="1" value="{{ old('sy_from',$sy_from) }}" style="font-size: 13px">
                      </div>
                      <div class="col-md-3">
                         <label for="">Service Year To</label>
                        <input type="number" name="sy_to" id="sy_to" class="form-control" placeholder="1" value="{{ old('sy_to',$sy_to) }}" style="font-size: 13px">
                      </div>
                      <div class="col-md-3">
                           <label for="">Age From</label>
                           <input type="number" name="age_from" id="age_from" class="form-control" placeholder="1" value="{{ old('age_from',$age_from) }}" style="font-size: 13px">
                      </div>
                      <div class="col-md-3">
                         <label for="">Age To</label>
                        <input type="number" name="age_to" id="age_to" class="form-control" placeholder="1" value="{{ old('age_to',$age_to) }}" style="font-size: 13px">
                      </div>
                    </div>
                    <br>
                    <div class="row">
                         <div class="col-md-3">
                             <label for="">Employement Status</label>
                            <select class="form-control" id="emp_type" name="emp_type" style="font-size: 13px">
                              <option value="">All</option>  
                              <option value="1" {{ (old('emp_type',$emp_type)=="1")?'selected':'' }}>New</option>
                              <option value="2" {{ (old('emp_type',$emp_type)=="2")?'selected':'' }}>Rejoin</option>
                              <option value="3" {{ (old('emp_type',$emp_type)=="3")?'selected':'' }}>On Join Training</option>
                              <option value="4" {{ (old('emp_type',$emp_type)=="4")?'selected':'' }}>Probation</option>
                              <option value="5" {{ (old('emp_type',$emp_type)=="5")?'selected':'' }}>Permanent</option>
                             </select>
                        </div>
                    </div>
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


<form action="{{route('employee.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
    <div class="row">  
            <div class="col-md-2">
                <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
            </div> 
            <div class="col-md-2">
                 <!-- Trigger the modal with a button -->
                  <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#myModal" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button>
            </div>
            <div class="col-md-8" align="right">
              @can('employee-create')
              <a class="btn btn-success unicode" href="{{route('employee.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Employee</a>
              @endcan
            </div>
            
  </div>        

</form> 

<div class="row">
  <div class="col-md-2">
     <p style="padding-top: 20px" class="unicode">Total record: {{$count}}</p>
  </div>

    <div class="col-md-10 text-right">
             <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-eye-slash"></i>
                <span class="caret"></span></button>
                <ul class="dropdown-menu" id="grpChkBox">
                  <li class="list-group-item clickable toggle-table-column">
                    <input type="checkbox" checked="checked" name="image" /> &nbsp;Image&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="employee_id" /> &nbsp;Employee Id&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="name" /> &nbsp;Name&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column">
                    <input type="checkbox" checked="checked" name="rank" /> &nbsp;Rank&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="department" /> &nbsp;Department&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                     <input type="checkbox" checked="checked" name="branch" /> &nbsp;Branch&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                     <input type="checkbox" checked="checked" name="join_date" /> &nbsp;Joined Date&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column">
                      <input type="checkbox" checked="checked" name="phone_no" /> &nbsp;Phone No&nbsp;&nbsp;
                  </li>
                  <li class="list-group-item clickable toggle-table-column"> 
                    <input type="checkbox" checked="checked" name="age" /> &nbsp;Age&nbsp;&nbsp;
                  </li>
                  
                </ul>
              </div>
       </div> 

</div>
 
 

    <div class="table-responsive unicode" style="font-size:14px;">
                <table class="table table-bordered styled-table unicode" id="empoloyeeTable">
                  <thead>
                    <tr> 
                      <th class="no">No</th>
                      <th class="image">Image</th>
                       <th class="employee_id">Employee Id</th>
                       <th class="name">Name</th>
                       <th class="rank">Rank</th>
                        <th class="department">Department</th>
                        <th class="branch">Branch</th>
                        <th class="joined_date">Joined Date</th>
                        <th class="phone_no">Phone No</th>
                        <th class="age">Age</th>
                        <th>Download PDF</th>
                        <th>Status</th>
                        <!-- <th></th> -->
                       <!--  <th>NRC</th>
                        <th>DOB</th> -->
                        <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                    <tbody>
                    @if($employees->count()>0)
              		 @foreach($employees as $employee)
                        <tr class="table-tr" data-url="{{route('employee.show',$employee->id)}}">
                            <td class="no">{{++$i}}</td>
                            @if($employee->photo == '')
                            <td class="image">
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td class="image">
                             <img src="{{ asset('uploads/employeePhoto/'.$employee->photo)}}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                            <td class="employee_id">{{$employee->emp_id}}</td>
                            <td class="name">{{$employee->name}}</td>
                             <td class="rank">{{$employee->viewPosition->name}}</td>
                            <td class="department">{{$employee->viewDepartment->name}}</td>
                            <td class="branch">{{$employee->viewBranch->name}}</td>
                            <?php 
                                  $currentyear = date('Y');
                                  $currentday = date('m');
                                  $creentmonth = date('d');
                                  // dd($creentmonth);
                                  $joinday = date('m',strtotime($employee->join_date));
                                  $joinyear = date('Y',strtotime($employee->join_date));
                                  $joinmonth = date('d',strtotime($employee->join_date));
                                  // dd($joinmonth);
                                  if($currentday < $joinday || $creentmonth < $joinmonth) {
                                    $work = $currentyear - $joinyear;
                                    $workyear = $work - 1;
                                  }else {
                                    $workyear = $currentyear - $joinyear;
                                  }
                              ?>
                             
                            <td class="joined_date">{{date('d-m-Y',strtotime($employee->join_date))}} <br>
                              {{-- ({{  Carbon\Carbon::parse($employee->join_date)->age + 1}}) years --}}
                              @php  
                                $d1 = new DateTime(date('Y-m-d',strtotime($employee->join_date)));
                                $d2 = new DateTime(date("Y-m-d"));
                                $interval = $d1->diff($d2);
                                $format = $interval->format('%yY, %mM, %dD');

                              @endphp
                               ({{ $format }})
                            </td>
                            <td class="phone_no">{{$employee->phone_no}}</td>

                            <?php 
                               $currentyearbirth = date('Y');
                               $currentdaybitrh = date('m');
                               $currentmonthbirth = date('d');
                               $joindaybirth = date('m',strtotime($employee->date_of_birth));
                               $joinyearbirth = date('Y',strtotime($employee->date_of_birth));
                               $joinmonthbirth = date('d',strtotime($employee->date_of_birth));
                               if($currentdaybitrh < $joindaybirth || $currentmonthbirth < $joinmonthbirth) {
                                 $workbirth = $currentyearbirth - $joinyearbirth;
                                 $workyearbirth = $workbirth ;
                               }else {
                                 $workyearbirth = $currentyearbirth - $joinyearbirth;
                               }
                               ?>

                            <td class="age">{{date('d-m-Y',strtotime($employee->date_of_birth))}}  <span>({{ Carbon\Carbon::parse($employee->date_of_birth)->age + 1 }}) years</span></td>
                           <td><a href="{{route('downloadPDF',$employee->id)}}">Download PDF</a></td>

                            <td>
                              <label class="switch">
                              <input data-id="{{$employee->id}}" data-size ="small" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $employee->active? 'checked' : '' }}>
                               <span class="slider round"></span>
                           </label>
                            </td>
                           <!-- <td>
                              <a class="btn btn-warning btn-sm" style="margin-right: 10px;font-size: 13px" href="{{route('user.update',$employee->id)}}"></i>Update</a><br>
                           </td> -->
                           
                        </tr>
                        
			           @endforeach
                  @else
                      <tr align="center">
                        <td colspan="10">No Data!</td>
                      </tr>
                  @endif
                    </tbody>
           </table> 
        {!! $employees->appends(request()->input())->links() !!}
    </div>
@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
  <style type="text/css">
     th{
        background-color: rgba(0,0,0,.03);
    }
    .page_body{
        margin: 10px;
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


@stop

@section('js')
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>

{{--   <script type="text/javascript" src="{{ asset('toastermin.js')}}"></script>
  <script src=" {{ asset('toasterjquery.js') }}" ></script> --}}

   <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
 <script type="text/javascript"> 
        @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif

         $(function () {
          var $chk = $("#grpChkBox input:checkbox"); 
          var $tbl = $("#empoloyeeTable");
          var $tblhead = $("#empoloyeeTable th");
       
          $chk.prop('checked', true); 
       
          $chk.click(function () {
              var colToHide = $tblhead.filter("." + $(this).attr("name"));
              var index = $(colToHide).index();
              $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
          });
        });


        $(document).ready(function(){

           $(function() {
            $('.livesearch').select2({
            
            placeholder: 'All',
            allowClear: true,
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-department")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });
            setTimeout(function(){
            $("div.alert").remove();
            }, 1000 ); 

            $(function() {
                $('#name').on('change',function(e) {
                this.form.submit();
            });

            //   $('#branch_id').on('change',function(e){
            //     this.form.submit();
            //   });
            //   $('#dep_id').on('change',function(e){
            //     this.form.submit();
            //   });
              
            //   $('#position_id').on('change',function(e){
            //     this.form.submit();
            //   });

            //   $('#gender').on('change',function(e){
            //     this.form.submit();
            //   });

            //   $('#hostel').on('change',function(e){
            //     this.form.submit();
            //   });

              

            //   $('#join_date').on('change',function(e) {
            //       this.form.submit();
            //      // $( "#form_id" )[0].submit();   
            //   });
            //  $('#join_month').on('change',function(e) {
            //     this.form.submit();
            //    // $( "#form_id" )[0].submit();   
            // });

          //      $( "#morefilter" ).click(function(e) {
          //     e.preventDefault();
          //     if($('#adv_filter:visible').length)
          //         $('#adv_filter').hide("slide", { direction: "right" }, 1000);
          //     else
          //     $('#adv_filter').show("slide", { direction: "right" }, 1000);
          // });
          // 
          // 


          $(function() {
            $(document).find("#clear_search").click(function(){
                $(document).find("select").val('');
                $(document).find("input").val('');
            });
          });


   
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });
          $("#join_date").datepicker({ dateFormat: 'dd-mm-yy' });


           $("#join_month").datepicker({dateFormat: 'dd-mm-yy'});

           $('#export_btn').click(function(){
                $('#excel_form').submit();
            });
         
        });


        $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var file_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "<?php echo route('change-status-employee') ?>",
                        data: {'active': status, 'file_id': file_id},
                        success: function(data){
                         console.log(data.success);
                        }
                    });
                })
              });

         $(function() {
            $('.livesearch').select2({
            placeholder: 'Select Department',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-department")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });

     </script>
@stop
