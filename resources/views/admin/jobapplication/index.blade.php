

@extends('adminlte::page')

@section('title', 'Job Application')

@section('content_header')

 <h5 style="color: blue;">Jobapplication Management</h5>

@stop
@section('content')

<?php
        $name = isset($_GET['name'])?$_GET['name']:'';
        $status = isset($_GET['status'])?$_GET['status']:'';
        $finterview_date = isset($_GET['finterview_date'])?$_GET['finterview_date']:'';
        $sinterview_date = isset($_GET['sinterview_date'])?$_GET['sinterview_date']:'';
        $secondinv_fromdate = isset($_GET['secondinv_fromdate'])?$_GET['secondinv_fromdate']:'';
        $secondinv_todate = isset($_GET['secondinv_todate'])?$_GET['secondinv_todate']:'';
?>


      {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
      @endif --}}

    <form action="{{route('jobapplication.index')}}" method="get" accept-charset="utf-8" class="form-horizontal">
     <div class="row form-group">
      <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
              <label for="" class="unicode">Search by Keyword</label>
               <input type="text" name="name" id="name" value="{{ old('name',$name) }}" class="form-control" placeholder="Search..." style="font-size: 13px">
            </div>
            <div class="col-md-2">
              <label>Select Interview Step</label>
               <select class="form-control" id="status" name="status" style="font-size: 13px">
                <option value="">All</option>  
                <option value="0" {{ (old('status',$status)=="0")?'selected':'' }}>New</option>
                <option value="1" {{ (old('status',$status)=="1")?'selected':'' }}>First Interview</option>
                <option value="2" {{ (old('status',$status)=="2")?'selected':'' }}>Second Interview</option>
                <option value="3" {{ (old('status',$status)=="3")?'selected':'' }}>Done</option>
                <option value="4" {{ (old('status',$status)=="4")?'selected':'' }}>
                Cancel</option>
               </select>
            </div>
            <div class="col-md-2">
              <label>First_Inv From Date</label>
               <input type="text" name="finterview_date" id="finterview_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('finterview_date',$finterview_date) }}">
            </div>
             <div class="col-md-2">
              <label>First_Inv To Date</label>
               <input type="text" name="sinterview_date" id="sinterview_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('sinterview_date',$sinterview_date) }}">
            </div>

            <div class="col-md-2">
              <label>Second_Inv From Date</label>
               <input type="text" name="secondinv_fromdate" id="secondinv_fromdate"class="form-control unicode" placeholder="01-08-2020" value="{{ old('secondinv_fromdate',$secondinv_fromdate) }}">
            </div>
             <div class="col-md-2">
              <label>Second_Inv To Date</label>
               <input type="text" name="secondinv_todate" id="secondinv_todate"class="form-control unicode" placeholder="01-08-2020" value="{{ old('secondinv_todate',$secondinv_todate) }}">
            </div>
        </div>

      </div>
      
     </div>
    </form>

     <p style="padding-top: 15px">Total record: {{$count}}</p>
    <div class="table-responsive" style="font-size:14px">
            <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Rank</th>
                      <th>Education</th>
                      <th>Appointment Date</th>
                      <th>Interview Step</th>
                      <!-- <th>Experience</th> -->
                    </tr>
                  </thead>
                    <tbody>
                   @if($jobapplications->count()>0)
                   @foreach($jobapplications as $jobapplication)
                        <tr class="table-tr" data-url="{{route('jobapplication.show',$jobapplication->id)}}" >
                            <td style="{{ $jobapplication->status == 1 ? 'color: #2874A6 ' : '' }}">{{++$i}}</td>
                             @if($jobapplication->photo == '')
                            <td>
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="80px" height="80px">
                            </td>
                            @else
                            <td>
                             <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplication->photo) }}" alt="photo" width="80px" height="80px">
                             </td>
                             @endif
                             <td>{{$jobapplication->name}}</td>
                              <td >{{$jobapplication->viewDepartment->name}}</td>
                            <td>{{$jobapplication->viewPosition->name}}</td>
                           
                           
                          
                          
                           
                           <td >{{$jobapplication->edu}}</td>
                           <td >{{$jobapplication->first_date ? date('d M Y',strtotime($jobapplication->first_date)) : "-" }}<br>
                            {{$jobapplication->second_date ? date('d M Y',strtotime($jobapplication->second_date)) : "-" }}
                           </td>
                           @if($jobapplication->status == 0)
                           <td >New</td>
                           @elseif($jobapplication->status == 1)
                           <td >First Interview</td>
                            @elseif($jobapplication->status == 2)
                            <td>Second Interview</td>
                            @elseif($jobapplication->status == 3)
                            <td>Done</td>
                            @elseif($jobapplication->status == 4)
                            <td>Cancel</td>
                            @endif
                           <!-- <td >{{$jobapplication->experience}}</td> -->
                        </tr>
                        
                 @endforeach
                 @else
                      <tr align="center">
                        <td colspan="10">No Data!</td>
                      </tr>
                  @endif
                    </tbody>
           </table> 
        {!! $jobapplications->appends(request()->input())->links() !!}
       </div>  
@stop 
@section('css')
   
    <link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
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
                $('#status').on('change',function(e) {
                this.form.submit();
            
              }); 
               $('#finterview_date').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            });
                $('#sinterview_date').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            });
                 $('#secondinv_todate').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            });
                $('#secondinv_fromdate').on('change',function(e) {
                this.form.submit();
               // $( "#form_id" )[0].submit();   
            });
        });
          $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
          $("#finterview_date").datepicker({ dateFormat: 'dd-mm-yy' });
          $("#sinterview_date").datepicker({ dateFormat: 'dd-mm-yy' });
          $("#secondinv_todate").datepicker({ dateFormat: 'dd-mm-yy' });
          $("#secondinv_fromdate").datepicker({ dateFormat: 'dd-mm-yy' });
        });


         
        });
     </script>
@stop
