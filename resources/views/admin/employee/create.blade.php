@extends('adminlte::page')
@section('title', 'Employee')
@section('content_header')
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
<div class="container">
   <div class="row">
      <div class="col-lg-11">
         <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
      </div>
   </div>
   <br>
   <form action="{{route('employee.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
      @csrf
      @method('post')
      <div class="tabs">
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-1" name="tabby-tabs" checked disabled="true">
            <label for="tab-1">Personal</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Name*</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="name" class="form-control unicode" placeholder="Mg Mg" id="name"> 
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Parent's Name</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="father_name" class="form-control unicode" placeholder="U Mya" id="father">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Gender*</h6>
                        </div>
                        <div class="col-md-2 {{ $errors->first('gender', 'has-error') }}">
                           <input type="radio" name="gender" value="Male" id="gender" checked> <small>Male</small>
                        </div>
                        <div class="col-md-2">
                           <input type="radio" name="gender" value="Female" id="gender"> <small>Female</small>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Date of Birth*</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('lat', 'has-error') }}">
                           <input type="text" name="date_of_birth" class="form-control unicode" id="date_of_birth" placeholder="01-01-2020">
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">NRC*</h6>
                        </div>
                        <div class="col-md-2 {{ $errors->first('name', 'has-error') }}">
                           <select class="form-control select2bs4" name="nrc_code" id="code_id">
                              <option value="">-</option>
                              @foreach ($nrccodes as $nrccode )
                              <option  value="{{$nrccode->id}}">{{$nrccode->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-2 {{ $errors->first('name', 'has-error') }}">
                           <select class="form-control" name="nrc_state" id="state_id">
                              <option value="">-</option>
                              <!--   @foreach ($departments as $department )
                                 <option  value="{{$department->id}}">{{$department->name}}</option>
                                 @endforeach -->
                           </select>
                        </div>
                        <div class="col-md-2{{ $errors->first('name', 'has-error') }}">
                           <select name="nrc_status" id="nrc_status" class="form-control select2bs4">
                              <option value="N" selected>N</option>
                              <option value="P">P</option>
                              <option value="E">E</option>
                              <option value="A">A</option>
                              <option value="F">F</option>
                              <option value="TH">TH</option>
                              <option value="G">G</option>
                           </select>
                        </div>
                        <div class="col-md-2 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="nrc" class="form-control unicode" placeholder="111111" id="nrc">
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Email*</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="email" name="email" class="form-control unicode">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;"> Race</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('lat', 'has-error') }}">
                           <input type="text" name="race" class="form-control unicode">
                           <!--   <input type="text" name="religion" class="form-control unicode"> -->
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;"> Religion</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('lat', 'has-error') }}">
                           <select class="form-control unicode" name="religion">
                              <option value="Buddhism">Buddhism</option>
                              <option value="Christianity">Christianity</option>
                              <option value="Islam">Islam</option>
                              <option value="Hinduism">Hinduism</option>
                           </select>
                           <!--   <input type="text" name="religion" class="form-control unicode"> -->
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Marrical Stauts*</h6>
                        </div>
                        <div class="col-md-2 {{ $errors->first('marrical_status', 'has-error') }}">
                           <input type="radio" name="marrical_status" value="Married
                              " id="marrical_status" checked> <small>Married</small>
                        </div>
                        <div class="col-md-2">
                           <input type="radio" name="marrical_status" value="Single
                              " id="marrical_status"> <small>Single</small>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Photo*</h6>
                        </div>
                        <div class="col-md-8 ">
                           <!-- <input type="file" name="photo" class="form-control unicode" onchange="PreviewImage();"> -->
                           <input type='file' id="imgInp" name="photo" class="form-control unicode"/>
                           <img id="blah" src="#" alt="your image" width="100" height="100" />
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <br> -->
               <!--  <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-6">
                      <div class="row">
                          <div class="col-md-2">
                              <h6 style="font-weight:bold;font-size:13px;">Photo</h6>
                          </div>
                          
                          <div class="col-md-8">
                          <div class="input-group control-group increment" >
                            <input type="file" name="filename[]" class="form-control" multiple>
                          </div>
                          </div>
                      </div>
                  </div>
                  </div> -->
               <br>
               <!--   <div class="row">
                  <div class="col-md-6">
                   <div class="row">
                       <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Email*</h6>
                       </div>
                  
                       <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                  
                          <input type="email" name="email" class="form-control unicode">
                  
                       </div>
                   </div>
                  </div>
                  <div class="col-md-6"></div>
                  </div> -->
               <div style="width: 100%">
                  <!-- <div class="col-md-6">
                     </div>
                     <div class="col-md-6">
                         <div class="row">
                             <div class="col-md-2">
                                 
                             </div>
                             
                             <div class="col-md-8">
                             <div class="input-group control-group increment" >
                             <a class="btn btn-success unicode" id="cust_next">Next</a>
                             </div>
                             </div>
                         </div>
                     </div> -->
                  <a class="btn btn-success unicode" id="cust_next" style="float: right;">Next</a>
               </div>
            </div>
         </div>
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-2" name="tabby-tabs" disabled="true">
            <label for="tab-2">Contact</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Phone*</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="number" name="phone_no" class="form-control unicode" id="mobile" placeholder="09 xxx xxx xxx">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">City*</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="city" class="form-control unicode" placeholder="Naypyidaw" id="city">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Parent Phone*</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="number" name="pPhone" class="form-control unicode">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Township*</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="township" class="form-control unicode" placeholder="pyinmana" id="township">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <!--  <div class="col-md-6">
                     <div class="row">
                         <div class="col-md-3">
                             <h6 style="font-weight:bold;font-size:13px;">Email*</h6>
                         </div>
                     
                         <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                     
                            <input type="email" name="email" class="form-control unicode">
                     
                         </div>
                     </div>
                     </div> -->
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Address*</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <textarea name="address" rows="4" class="form-control unicode" id="address" placeholder="Paung Long 4 street,Pyinmana"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="contact_back" style="float: left;">Back</a>
                  <a class="btn btn-success unicode" id="contact_next" style="float: right;">Next</a>
                  <!-- <div class="col-md-1"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="photo_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="photo_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-3" name="tabby-tabs" disabled="true">
            <label for="tab-3">Education</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Graduation</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="graduation" class="form-control unicode" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">University/School</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="qualification" class="form-control unicode" placeholder="Grade-10" id="city">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Course Title</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="course_title" class="form-control unicode" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Level</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <select class="form-control unicode" name="level">
                              <option value="">Select</option>
                              <option value="1">Level-1</option>
                              <option value="2">Level-2</option>
                              <option value="3">Level-3</option>
                              <option value="4">Level-4</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Degree/Certification </h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="file" name="degree" class="form-control unicode" >
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="qualification_back" style="float: left;">Back</a>
                  <a class="btn btn-success unicode" id="qualification_next" style="float: right;">Next</a>
                  <!-- <div class="col-md-1"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="photo_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="photo_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-4" name="tabby-tabs" disabled="true">
            <label for="tab-4">Work Exp</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Company Name</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="exp_company" class="form-control unicode">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Job Position</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="exp_position" class="form-control unicode">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">From Date</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="exp_date_from" class="form-control unicode" id="from_date">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">To Date</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="exp_date_to" class="form-control unicode" id="to_date">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Location</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <input type="text" name="exp_location" class="form-control unicode">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="workexp_back" style="float: left;">Back</a>
                  <a class="btn btn-success unicode" id="workexp_next" style="float: right;">Next</a>
                  <!-- <div class="col-md-1"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="photo_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="photo_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-5" name="tabby-tabs" disabled="true">
            <label for="tab-5">Employment</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Employee ID</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="emp_id" class="form-control unicode" id="emp_id">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Join Date*</h6>
                        </div>
                        <div class="col-md-9">
                           <input type="text" name="join_date" class="form-control unicode" id="join_date" placeholder="1-01-2021">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;" id="assign_label">Department*</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                        <div class="col-md-8">
                           <!--  <select class="form-control" name="department"></select> -->
                           <select class="form-control" name="department" id="department">
                              <option value="">Department</option>
                              @foreach ($departments as $department )
                              <option  value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;" id="assign_label">Branch*</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                        <div class="col-md-9">
                           <select class="form-control" name="branch" id="branch">
                              <option value="">Branch</option>
                              @foreach ($branchs as $branch )
                              @if($branch->status == 1)
                              <option  value="{{$branch->id}}">{{$branch->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Rank*</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="appointment_label" style="text-align: right;">Appoint Date</label> -->
                        <div class="col-md-8">
                           <!-- <select class="form-control" name="position"></select> -->
                           <select class="form-control" name="position" id="rank">
                              <option value="">Rank</option>
                              @foreach ($positions as $position )
                              <option  value="{{$position->id}}">{{$position->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row" id="isHostel">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">isHostel*</h6>
                        </div>
                        <div class="col-md-2 {{ $errors->first('gender', 'has-error') }}">
                           <input type="radio" name="isHostel" value="Yes" id="isHostel"> <small>Yes</small>
                        </div>
                        <div class="col-md-2">
                           <input type="radio" name="isHostel" value="No" checked id="isHostel"> <small>No</small>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row" id="firstradio">
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Start Date</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="hostel_sdate" class="form-control unicode" id="hostel_sdate" placeholder="01-01-2021">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6" >
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Hostel Name</h6>
                        </div>
                        <div class="col-md-9">
                           <select class="form-control" name="home_no" style="font-size: 13px" >
                              <option value="">select hostel</option>
                              @foreach ($hostels as $hostel )
                              <option  value="{{$hostel->id}}">{{$hostel->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row" id="secondradio">
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Full Address</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="hostel_location" class="form-control unicode" id="full_address">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Room No</h6>
                        </div>
                        <div class="col-md-9">
                           <!--  <input type="text" name="room_no" class="form-control unicode"> -->
                           <select class="form-control" name="room_no" style="font-size: 13px">
                              <option value="">-</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Ro</h6>
                        </div>
                        <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                           <select class="livesearchs form-control" name="ro_id"></select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Employment Type</h6>
                        </div>
                        <div class="col-md-9">
                           <select class="form-control unicode" name="employment_type">
                              <option value="">Select</option>
                              <option value="1">New</option>
                              <option value="2">Rejoin</option>
                              <option value="3">On Job Training</option>
                              <option value="4">Probation</option>
                              <option value="5">Permanent</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Expected Salary</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="appointment_label" style="text-align: right;">Appoint Date</label> -->
                        <div class="col-md-8">
                           <input type="text" name="salary" class="form-control unicode"> 
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="employee_back" style="float: left;">Back</a>
                  <a class="btn btn-success unicode" id="employee_next" style="float: right;">Next</a>
                  <!--  <button type="submit" class="btn btn-success unicode" style="float: right;">Save</button> -->
                  <!-- <div class="col-md-4"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="assign_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="assign_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-6" name="tabby-tabs" disabled="true">
            <label for="tab-6">Skill</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-2">
                           <h6 style="font-weight:bold;font-size:13px;">Skills</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="skills" class="form-control unicode">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Skill proficiency</h6>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="proficiency" class="form-control unicode">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="skill_back" style="float: left;">Back</a>
                  <a class="btn btn-success unicode" id="skill_next" style="float: right;">Next</a>
                  <!--  <button type="submit" class="btn btn-success unicode" style="float: right;">Save</button> -->
                  <!-- <div class="col-md-4"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="assign_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="assign_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
         <div class="tabby-tab" >
            <input type="radio" id="tab-7" name="tabby-tabs" disabled="true">
            <label for="tab-7">Attach File</label>
            <div class="tabby-content">
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">CV form attach file</h6>
                        </div>
                        <div class="col-md-8">
                           <input id="degree/certification" type="file" class="form-control resume" placeholder="" name="cvfile">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;">Police reco Photo</h6>
                        </div>
                        <div class="col-md-8">
                           <input id="graduation" type="file" class="form-control resume" placeholder="" name="police_reco">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;" id="assign_label">Ward reco Photo</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                        <div class="col-md-8">
                           <input id="university/college" type="file" class="form-control resume" placeholder="" name="ward_reco">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3">
                           <h6 style="font-weight:bold;font-size:13px;" id="assign_label">Other file</h6>
                        </div>
                        <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                        <div class="col-md-8">
                           <input id="degree/certification" type="file" class="form-control resume" placeholder="" name="otherfile">
                        </div>
                     </div>
                  </div>
               </div>
               <br>
               <div style="width: 100%">
                  <a class="btn btn-primary unicode" id="file_back" style="float: left;">Back</a>
                  <button type="submit" class="btn btn-success unicode" style="float: right;">Save</button>
                  <!--  <button type="submit" class="btn btn-success unicode" style="float: right;">Save</button> -->
                  <!-- <div class="col-md-4"></div>
                     <div class="col-md-2">
                         <a class="btn btn-primary unicode" id="assign_back">Back</a>
                     </div>
                     <div class="col-md-2">
                         <div class="row">
                             <a class="btn btn-success unicode" id="assign_next">Next</a> 
                         </div>
                         
                     </div> -->
               </div>
            </div>
         </div>
      </div>
</div>
</div>
</div>
</div>
</form>
@stop
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
<style>
   /* ------------------- */
   /* TEMPLATE        -- */
   /* ----------------- */
   /* @import url(https://fonts.googleapis.com/css?family=Lato:400, 700, 900, 300); */
   p {
   margin: 0 0 15px;
   line-height: 24px;
   color: gainsboro;
   }
   h6 {
   font-size: 15px;
   color: black;
   }
   a:hover {
   color: tomato;
   }
   .container {
   max-width: 100%;
   margin: 0 auto;
   }
   /* ------------------- */
   /* PEN STYLES      -- */
   /* ----------------- */
   /* MAKE IT CUTE ----- */
   .tabs {
   position: relative;
   display: flex;
   min-height: 1000px;
   border-radius: 8px 8px 0 0;
   overflow: hidden;
   }
   .tabby-tab {
   flex: 1;
   }
   .tabby-tab label {
   display: block;
   box-sizing: border-box;
   /* tab content must clear this */
   height: 40px;
   padding: 10px;
   text-align: center;
   background:  #2a3c66;
   color: white;
   cursor: pointer;
   transition: background 0.5s ease;
   }
   .tabby-tab label:hover {
   background: white;
   color:  #2a3c66;
   border-bottom: 1px solid  #2a3c66;
   }
   .tabby-content {
   position: absolute;
   left: 0;
   bottom: 0;
   right: 0;
   /* clear the tab labels */
   top: 40px;
   padding: 20px;
   border-radius: 0 0 8px 8px;
   /* background:#efedf1; */
   /* show/hide */
   opacity: 0;
   transform: scale(0.1);
   transform-origin: top left;
   padding-bottom: 50px;
   }
   .tabby-content img {
   float: left;
   margin-right: 20px;
   border-radius: 8px;
   }
   /* MAKE IT WORK ----- */
   .tabby-tab [name="tabby-tabs"] {
   display: none;
   }
   [name="tabby-tabs"]:checked~label {
   background: white;
   z-index: 2;
   color:  #2a3c66;
   border-bottom: 1px solid  #2a3c66;
   }
   [name="tabby-tabs"]:checked~label~.tabby-content {
   z-index: 1;
   opacity: 1;
   transform: scale(1);
   }
   /* BREAKPOINTS ----- */
   @media screen and (max-width: 767px) {
   .tabs {
   min-height: 400px;
   }
   }
   @media screen and (max-width: 480px) {
   .tabs {
   min-height: 580px;
   }
   .tabby-tab label {
   height: 60px;
   }
   .tabby-content {
   top: 60px;
   }
   .tabby-content img {
   float: none;
   margin-right: 0;
   margin-bottom: 20px;
   }
   }
   #myImg {
   border-radius: 5px;
   cursor: pointer;
   transition: 0.3s;
   }
   #myImg:hover {
   opacity: 0.7;
   }
   /* The Modal (background) */
   .modal {
   display: none;
   /* Hidden by default */
   position: fixed;
   /* Stay in place */
   z-index: 1;
   /* Sit on top */
   padding-top: 100px;
   /* Location of the box */
   left: 0;
   top: -10;
   width: 100%;
   /* Full width */
   height: 100%;
   /* Full height */
   overflow: auto;
   /* Enable scroll if needed */
   background-color: rgb(243, 237, 237);
   /* Fallback color */
   background-color: rgba(221, 215, 215, 0.9);
   /* Black w/ opacity */
   }
   .modal1 {
   display: none;
   /* Hidden by default */
   position: fixed;
   /* Stay in place */
   z-index: 1;
   /* Sit on top */
   padding-top: 100px;
   /* Location of the box */
   left: 0;
   top: 0;
   width: 100%;
   /* Full width */
   height: 72%;
   /* Full height */
   overflow: auto;
   /* Enable scroll if needed */
   background-color: rgb(243, 237, 237);
   /* Fallback color */
   background-color: rgba(221, 215, 215, 0.9);
   /* Black w/ opacity */
   }
   /* Modal Content (image) */
   .modal-content {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 595px;
   max-height: 842px;
   margin-left: 22%;
   }
   .modal-content1 {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 595px;
   max-height: 442px;
   margin-left: 22%;
   }
   /* Caption of Modal Image */
   #caption {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   text-align: center;
   color: #ccc;
   padding: 10px 0;
   height: 150px;
   }
   /* Add Animation */
   .modal-content,
   #caption {
   -webkit-animation-name: zoom;
   -webkit-animation-duration: 0.6s;
   animation-name: zoom;
   animation-duration: 0.6s;
   }
   @-webkit-keyframes zoom {
   from {
   -webkit-transform: scale(0)
   }
   to {
   -webkit-transform: scale(1)
   }
   }
   @keyframes zoom {
   from {
   transform: scale(0)
   }
   to {
   transform: scale(1)
   }
   }
   /* The Close Button */
   .close {
   position: absolute;
   top: 15px;
   right: 35px;
   color: red;
   font-size: 40px;
   font-weight: bold;
   transition: 0.3s;
   }
   .close:hover,
   .close:focus {
   color: #bbb;
   text-decoration: none;
   cursor: pointer;
   }
   /* 100% Image Width on Smaller Screens */
   @media only screen and (max-width: 700px) {
   .modal-content {
   width: 100%;
   }
   }
   .select2-container .select2-selection--single {
   box-sizing: border-box;
   cursor: pointer;
   display: block;
   height: 35px;
   user-select: none;
   -webkit-user-select: none;
   }
   .select2-container--default .select2-selection--single .select2-selection__arrow {
   height: 30px;
   position: absolute;
   top: 2px;
   right: 1px;
   width: 20px;
   }
   border_bot {
   outline: 0 !important;
   border-width: 0 0 2px !important;
   border-color: blue !important;
   }
   border_bot:focus {
   border-color: green !important;
   }
</style>
@stop
@section('js')
<script src="{{ asset('frontend/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ asset('js/ajax.2.18.1') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{asset('js/jquery.2.1.1.min')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
   function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
   
    $("#imgInp").change(function() {
      readURL(this);
    }); 
   
    $(function(){
           $("#workexp_next").click(function(){
            // alert("hello");
             
              
                    $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo route('change-status-employeeid') ?>",
                    // data: {'emp_id': is_employee},
                    success: function(data){
                        $("#emp_id").val(data);
                        console.log(data);
                    }
                     });
            });
        });    
   
    $(document).ready(function(){
   
         $("select[name='home_no']").change(function() {
            // alert("hhi");
            var room_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: "<?php echo route('select-ajax-hostel') ?>",
                method: 'POST',
                dataType: 'html',
                data: {
                    room_id: room_id,
                    _token: token
                },
                    success: function(data) {
                        $("select[name='room_no']").html(data);
                    }
                });
            });
   
        $("select[name='home_no']").change(function(){
             // alert("hello");
              var is_employee = $(this).find(':selected').val();
              
                 $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "<?php echo route('get_department_address') ?>",
                        data: {'emp_id': is_employee},
                        success: function(data){
                            $("#full_address").val(data.full_address);
                            console.log(data.full_address);
                        }
                    });
        });
   
        var ss = $('input[name="isHostel"]:checked').val();
            if (ss == "No") {
               $("#firstradio").hide();
               $("#secondradio").hide();
            }else if (ss == "Yes") {
                $("#firstradio").show();
               $("#secondradio").show();
            }
   
             $('#isHostel').on('click', function () {
                var value = $("[name=isHostel]:checked").val();
   
                 if (value == "No") {
                       $("#firstradio").hide();
                       $("#secondradio").hide();
                    }else if (value == "Yes") {
                        $("#firstradio").show();
                       $("#secondradio").show();
                    }
            })
            $("#cust_next").click(function(){
                var name = $("#name").val();
                var gender = $("#gender").val();
                var date_of_birth = $("#date_of_birth").val();
                var nrc_code = $( "#nrc_code option:selected" ).text();
                var nrc = $("#nrc").val();
               
                if (name && gender && date_of_birth && nrc_code != "-" &&  nrc) {
                    // alert("HI");
                    $("#tab-2").prop("checked", true);
                    $("#tab-2").prop("disabled", false);
                    $("#tab-1").prop("disabled", false);
                }else if (!name) {
                    alert("Name is empty!");
                }else if(!gender){
                    alert("Gender is empty!");
                }else if(!date_of_birth){
                    alert("Date of birth is empty");
                }else if(!nrc){
                    alert("Nrc number is empty");
                }
                else if(nrc_code == "-"){
                    alert("Township is empty");
                }
        });
    });
    $("#qualification_next").click(function(){
        // var join_date = $("#join_date").val();
        // var rank = $("#rank option:selected").text();
        // var department = $("#department").val();
        // var branch = $("branch").val();
        // if (join_date && rank != "Rank" && department != "Department" && branch != "Branch") {
            $("#tab-4").prop("checked", true);
            $("#tab-3").prop("disabled", false);
            $("#tab-4").prop("disabled", false);
        // }else if(!join_date){
        //     alert("Join date is ampty");
        // }else if(rank == "Rank"){
        //     alert("Rank is empty");
        // }else if(department == "Department"){
        //     alert("Department is empty");
        // }else if(branch == "Branch"){
        //     alert("Branch is empty");
        // }
        
    });
    $("#qualification_back").click(function(){
        $("#tab-2").prop("checked", true); 
   
    });
    $("#skill_back").click(function(){
        $("#tab-5").prop("checked", true); 
   
    });
     $("#file_back").click(function(){
        $("#tab-6").prop("checked", true); 
   
    });
     $("#workexp_back").click(function(){
        $("#tab-3").prop("checked", true); 
   
    });
    $("#employee_back").click(function(){
        $("#tab-4").prop("checked", true);
    });
   
    $("#contact_back").click(function(){
        $("#tab-1").prop("checked", true);
        $("#tab-3").prop("disabled", false);
    });
    $("#contact_next").click(function(){
        $("#tab-3").prop("checked", true);
        $("#tab-2").prop("disabled", false);
        $("#tab-3").prop("disabled", false);
    });
     $("#workexp_next").click(function(){
        $("#tab-5").prop("checked", true);
        $("#tab-2").prop("disabled", false);
        $("#tab-3").prop("disabled", false);
   
    });
       $("#employee_next").click(function(){
        $("#tab-6").prop("checked", true);
        $("#tab-2").prop("disabled", false);
        $("#tab-3").prop("disabled", false);
    });
    $("#skill_next").click(function(){
        $("#tab-7").prop("checked", true);
        $("#tab-2").prop("disabled", false);
        $("#tab-3").prop("disabled", false);
    });
    $(".btn-danger").hide();
    $('#check_all').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".checkbox").prop('checked', true); 
            $(".btn-danger").show(); 
        } else {  
            $(".checkbox").prop('checked',false); 
            $(".btn-danger").hide(); 
        }  
    });
   
    var no = 0;
    $("#serial_table").on("click", ".checkbox", function(event) {
   
        if($(this).is(':checked',true))  
        {
            $(".btn-danger").show();
            $(".btn-danger").click(function(){
                $('.checkbox:checked').each(function () {
                    $(this).closest('tr').remove();
                    --number;
                    $(".item").each(function(){
   
                    });
                    $("#serial_table tbody tr").each(function(){
                        $("#serial_table tbody tr td:first").html(no+1);
                    });
                    calcInstallCharge();
                    calcAll();
                    
                });
            });
        } else {   
            $(".btn-danger").hide(); 
        }
   
        
    });
   
    $(document).ready(function(){
    $("select[name='nrc_code']").change(function() {
        // alert("Hello");
        var code_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('select-ajax-code') ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                nrc_code: code_id,
                _token: token
            },
            success: function(data) {
                $("select[name='nrc_state']").html(data);
            }
        });
    });
   
     $("#date_of_birth").datepicker({ dateFormat: 'dd-mm-yy' });
     $("#join_date").datepicker({ dateFormat: 'dd-mm-yy' });
     $("#from_date").datepicker({ dateFormat: 'dd-mm-yy' });
     $("#to_date").datepicker({ dateFormat: 'dd-mm-yy' });
     $("#hostel_sdate").datepicker({ dateFormat: 'dd-mm-yy' });
   
     
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
   
      $(function() {
        $('.livesearchrank').select2({
        placeholder: 'Select Rank',
        ajax: {
            url: "<?php echo(route("ajax-autocomplete-rank")) ?>",
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
   
   
        $(function() {
            $('.livesearchs').select2({
            placeholder: 'Employee Name',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-search")) ?>",
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