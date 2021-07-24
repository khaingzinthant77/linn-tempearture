
@extends('adminlte::page')

@section('title', 'jobapplication')

@section('content_header')
@stop

@section('content')
   

<div class="row">
        <div class="col-md-2">
             <a class="btn btn-success unicode" href="{{route('jobapplication.index')}}"> Back</a>
        </div>

        @if($jobapplications->status == 0)
             @if($jobapplications->first_date == '')
             <div class="col-md-10">
                {{--  <button type="button" class="btn btn-warning " id="moredatefilter" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#mydateModal" style="float: right;">First Date</button>
             </div>
     
             @else
                 <div class="col-md-10">
                    {{--  <button type="button" class="btn btn-warning " id="morefilter" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                    <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#myModal" style="float: right;">Call InterView</button>
                 </div>
             @endif
         @elseif($jobapplications->status == 1)
                @if($jobapplications->second_date == '')
                <div class="col-md-10">
                    {{--  <button type="button" class="btn btn-warning " id="moredatefilter" style="font-size: 13px"><i class="fa fa-filter" aria-hidden="true"></i></button> --}}
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#mydateModal" style="float: right;">Second Date</button>
                </div>
     
                @else
                  <div class="col-md-10">
                    <button type="button" class="btn btn-warning "  data-toggle="modal" data-target="#myModal" style="float: right;">Second InterView</button>
                 </div>
                 @endif
         @elseif($jobapplications->status == 2)
         <div class="col-md-10">
         <form action="{{route('jobapplication.store')}}" method="POST" accept-charset="utf-8" class="form-horizontal unicode">
            @csrf
            @method('post')
               <input type="hidden" name="nrc_code" value="{{$jobapplications->nrc_code}}">
                 <input type="hidden" name="nrc_state" value="{{$jobapplications->nrc_state}}">
                <input type="hidden" name="nrc_status" value="{{$jobapplications->nrc_status}}">
                <input type="hidden" name="nrc" value="{{$jobapplications->nrc}}">
                 <input type="hidden" name="fullnrc" value="{{$jobapplications->fullnrc}}">
                <input id="first-name" type="hidden" name="emp_id" class="form-control resume" placeholder="Name :" value="{{$jobapplications->id}}">
                 <input id="first-name" type="hidden" name="name" class="form-control resume" placeholder="Name :" value="{{$jobapplications->name}}">
                 <input type="hidden" class="form-control resume" placeholder="Parent Name :" name="fName" value="{{$jobapplications->fName}}">
                <input type="hidden" class="form-control resume" placeholder="01-01-2021 :" name="dob" value="{{date('d-m-Y',strtotime($jobapplications->dob))}}">
                <input type="hidden" class="form-control resume" name="religion" value="{{$jobapplications->religion}}">
                <input type="hidden" class="form-control resume" name="gender" value="{{$jobapplications->gender}}">
                <input type="hidden" class="form-control resume" name="marrical_status" value="{{$jobapplications->marrical_status}}">
                <input type="hidden" class="form-control resume" placeholder="email :" name="email" value="{{$jobapplications->email}}">
                <input type="hidden" class="form-control resume" value="{{$jobapplications->fullnrc}}">
                <input id="phone" type="hidden" class="form-control resume" name="phone" value="{{$jobapplications->phone}}">
                <input type="hidden" class="form-control resume" name="fPhone" value="{{$jobapplications->fPhone}}" >
                <input type="hidden" class="form-control resume" placeholder="City :" name="city" value="{{$jobapplications->city}}">
                <input type="hidden" class="form-control resume" placeholder="Township :" name="township" value="{{$jobapplications->township}}" >
                <input type="hidden" class="form-control resume" placeholder="Township :" name="address" value="{{$jobapplications->address}}" >
                <input id="graduation" type="hidden" class="form-control resume" placeholder="" name="graduation" value="{{$jobapplications->graduation}}">
                <input id="university/college" type="hidden" class="form-control resume" placeholder="" name="education" value="{{$jobapplications->edu}}">
                <input id="degree/certification" type="hidden" class="form-control resume" placeholder="" name="degree">
                <input type="hidden" class="form-control resume" placeholder="" name="level" value="{{$jobapplications->level}}"> 
                <input id="course-title" type="hidden" class="form-control resume" placeholder="" name="course_title" value="{{$jobapplications->course_title}}">
                <input id="company-name" type="hidden" class="form-control resume" placeholder="" name="exp_company" value="{{$jobapplications->exp_company}}">
                <input id="job-position" type="hidden" class="form-control resume" placeholder="" name="exp_position" value="{{$jobapplications->exp_position}}">
                <input id="job-position" type="hidden" class="form-control resume" placeholder="" name="exp_location" value="{{$jobapplications->exp_location}}">
                <input id="exp_date_from" type="hidden" class="form-control resume" placeholder="01-01-2021" name="exp_date_from" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_from))}}">
                <input id="exp_date_to" type="hidden" class="form-control resume" placeholder="01-01-2021" name="exp_date_to" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_to))}}">
                <input id="company-name" type="hidden" class="form-control resume"  readonly name="department" value="{{$jobapplications->department}}">
                <input id="job-position" type="hidden" class="form-control resume" readonly name="location" value="{{$jobapplications->job}}">
                <input id="company-name" type="hidden" class="form-control resume" name="appliedDate" value="{{date('d-m-Y')}}">
                <input id="company-name" type="hidden" class="form-control resume" placeholder="" name="salary" value="{{$jobapplications->exp_salary}}">
                <input type="hidden" name="hostel" value="{{ $jobapplications->hostel}}" > 
                <input id="skills" type="hidden" class="form-control resume" name="skills" value="{{$jobapplications->skills}}">
                <input id="skill_proficiency" type="hidden" class="form-control resume" placeholder="75%" name="proficiency" value="{{$jobapplications->proficiency}}">
                <input type="hidden" class="form-control resume" name="cvfile" value="{{$jobapplications->cvfile}}">
                <input type="hidden" class="form-control resume" name="ward_reco" value="{{$jobapplications->ward_reco}}">
                 <input type="hidden" class="form-control resume" name="police_reco" value="{{$jobapplications->police_reco}}">
                 <input type="hidden" class="form-control resume" name="otherfile" value="{{$jobapplications->otherfile}}">
                <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Done</button>
                
        </form>
        </div>
        @elseif($jobapplications->status == 4)
        <div class="col-md-10">
           <a class="btn btn-success unicode" href="{{route('recallinterview',$jobapplications->id)}}" style="float: right;">Recall</a>
        </div>
        @endif

        
</div><br>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        @if($jobapplications->status == 0)
         <h5 class="modal-title">First Interview</h5>
         @elseif($jobapplications->status == 1)
         <h5 class="modal-title">Second Interview</h5>
         @endif
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
         <form action="{{route('interview.store')}}" method="POST" accept-charset="utf-8" class="form-horizontal unicode" >
            @csrf
            @method('post')
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                         <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight:bold;font-size:13px;">Name</h6>
                                </div>

                                <div class="col-md-10 {{ $errors->first('name', 'has-error') }}">

                                    <input type="text" class="form-control unicode" value="{{$jobapplications->name}}" readonly style="background-color: white"> 
                                    <input type="hidden" name="emp_id" class="form-control unicode" value="{{$jobapplications->id}}"> 
                                     <input type="hidden" name="status" class="form-control unicode" value="{{$jobapplications->status}}"> 

                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight:bold;font-size:13px;">Step</h6>
                                </div>

                                <div class="col-md-10 {{ $errors->first('name', 'has-error') }}">
                                    @if($jobapplications->status == 0)
                                    <input type="text" name="step_id" class="form-control unicode" placeholder="First Interview" readonly style="background-color: white"> 
                                    <input type="hidden" name="step_id" class="form-control unicode" value="1"> 
                                    @elseif($jobapplications->status == 1)
                                     <input type="text" class="form-control unicode" placeholder="Second Interview" readonly style="background-color: white">
                                     <input type="hidden" name="step_id" class="form-control unicode" value="2" > 
                                     @endif

                                </div>
                            </div>
                        </div>
                       
                    </div><br>
                    <div class="row">
                        <div class="col-md-1">Remark</div>
                        <div class="col-md-11">
                            <textarea name="reason" rows="4" class="form-control unicode" id="reason" placeholder="Good"></textarea>
                            <input type="hidden" name="job_id" value="{{$jobapplications->id}}" id="job_id">
                        </div>
                    </div>
                    <br>
                     
                    <div class="row">
                       <div class="col-md-12" align="center">
                        @csrf
                        @method('post')
                        @if($jobapplications->status != 4)
                        
                        <!--  <a class="btn btn-success unicode" href="{{route('jobapplication.update',$jobapplications->id)}}" id="cancel"> Cancle</a> -->
                        <input type="submit" name="cancel" class="btn btn-success" id="cancel" value="Cancel" data-dismiss="modal">
                        
                        @endif
                         <button type="submit" class="btn btn-primary btn-sm">Save</button>
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



<!-- Date Modal -->
<div id="mydateModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        @if($jobapplications->status == 0)
         <h5 class="modal-title">First Date</h5>
         @elseif($jobapplications->status == 1)
         <h5 class="modal-title">Second Date</h5>
         @endif
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
         <form action="{{route('jobapplication.update',$jobapplications->id)}}" method="POST" accept-charset="utf-8" class="form-horizontal unicode" >
            @csrf
            @method('PUT')
            <div class="row form-group" id="adv_filter_date">
                <div class="col-md-12">
                    <div class="row">
                         <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight:bold;font-size:13px;">Name</h6>
                                </div>

                                <div class="col-md-10 {{ $errors->first('name', 'has-error') }}">

                                    <input type="text" class="form-control unicode" value="{{$jobapplications->name}}" readonly style="background-color: white"> 
                                   <!--  <input type="hidden" name="emp_id" class="form-control unicode" value="{{$jobapplications->id}}"> 
                                     <input type="hidden" name="status" class="form-control unicode" value="{{$jobapplications->status}}">  -->

                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight:bold;font-size:13px;">Date</h6>
                                </div>

                                <div class="col-md-10 {{ $errors->first('name', 'has-error') }}">
                                    @if($jobapplications->status == 0)
                                    <input type="text" name="first_date" class="form-control unicode" placeholder="01-01-2021" readonly style="background-color: white" id="first_date"> 
                                    
                                    @elseif($jobapplications->status == 1)
                                     <input type="text" name="second_date" class="form-control unicode" placeholder="01-01-2021" readonly style="background-color: white" id="second_date" value="{{$jobapplications->second_date}}">
                                     <input type="hidden" name="first_date" value="{{$jobapplications->first_date}}">
                                    
                                     @endif

                                </div>
                            </div>
                        </div>
                       
                    </div><br>
                     
                    <div class="row">
                       <div class="col-md-12" align="center">
                         <button type="submit" class="btn btn-primary btn-sm" >Save</button>
                       </div>
                    </div>
                </div>
               
            </div>

             <input type="hidden" name="nrc_code" value="{{$jobapplications->nrc_code}}">
                 <input type="hidden" name="nrc_state" value="{{$jobapplications->nrc_state}}">
                <input type="hidden" name="nrc_status" value="{{$jobapplications->nrc_status}}">
                <input type="hidden" name="nrc" value="{{$jobapplications->nrc}}">
                 <input type="hidden" name="fullnrc" value="{{$jobapplications->fullnrc}}">
                <input id="first-name" type="hidden" name="emp_id" class="form-control resume" placeholder="Name :" value="{{$jobapplications->id}}">
                 <input id="first-name" type="hidden" name="name" class="form-control resume" placeholder="Name :" value="{{$jobapplications->name}}">
                 <input type="hidden" class="form-control resume" placeholder="Parent Name :" name="fName" value="{{$jobapplications->fName}}">
                <input type="hidden" class="form-control resume" placeholder="01-01-2021 :" name="dob" value="{{date('d-m-Y',strtotime($jobapplications->dob))}}">
                <input type="hidden" class="form-control resume" name="religion" value="{{$jobapplications->religion}}">
                <input type="hidden" class="form-control resume" name="gender" value="{{$jobapplications->gender}}">
                <input type="hidden" class="form-control resume" name="marrical_status" value="{{$jobapplications->marrical_status}}">
                <input type="hidden" class="form-control resume" placeholder="email :" name="email" value="{{$jobapplications->email}}">
                <input type="hidden" class="form-control resume" value="{{$jobapplications->fullnrc}}">
                <input id="phone" type="hidden" class="form-control resume" name="phone" value="{{$jobapplications->phone}}">
                <input type="hidden" class="form-control resume" name="fPhone" value="{{$jobapplications->fPhone}}" >
                <input type="hidden" class="form-control resume" placeholder="City :" name="city" value="{{$jobapplications->city}}">
                <input type="hidden" class="form-control resume" placeholder="Township :" name="township" value="{{$jobapplications->township}}" >
                <input type="hidden" class="form-control resume" placeholder="Township :" name="address" value="{{$jobapplications->address}}" >
                <input id="graduation" type="hidden" class="form-control resume" placeholder="" name="graduation" value="{{$jobapplications->graduation}}">
                <input id="university/college" type="hidden" class="form-control resume" placeholder="" name="education" value="{{$jobapplications->edu}}">
                <input id="degree/certification" type="hidden" class="form-control resume" placeholder="" name="degree">
                <input type="hidden" class="form-control resume" placeholder="" name="level" value="{{$jobapplications->level}}"> 
                <input id="course-title" type="hidden" class="form-control resume" placeholder="" name="course_title" value="{{$jobapplications->course_title}}">
                <input id="company-name" type="hidden" class="form-control resume" placeholder="" name="exp_company" value="{{$jobapplications->exp_company}}">
                <input id="job-position" type="hidden" class="form-control resume" placeholder="" name="exp_position" value="{{$jobapplications->exp_position}}">
                <input id="job-position" type="hidden" class="form-control resume" placeholder="" name="exp_location" value="{{$jobapplications->exp_location}}">
                <input id="exp_date_from" type="hidden" class="form-control resume" placeholder="01-01-2021" name="exp_date_from" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_from))}}">
                <input id="exp_date_to" type="hidden" class="form-control resume" placeholder="01-01-2021" name="exp_date_to" value="{{date('d-m-Y',strtotime($jobapplications->exp_date_to))}}">
                <input id="company-name" type="hidden" class="form-control resume"  readonly name="department" value="{{$jobapplications->department}}">
                <input id="job-position" type="hidden" class="form-control resume" readonly name="location" value="{{$jobapplications->job}}">
                <input id="company-name" type="hidden" class="form-control resume" name="appliedDate" value="{{date('d-m-Y')}}">
                <input id="company-name" type="hidden" class="form-control resume" placeholder="" name="salary" value="{{$jobapplications->exp_salary}}">
                <input type="hidden" name="hostel" value="{{ $jobapplications->hostel}}" > 
                <input id="skills" type="hidden" class="form-control resume" name="skills" value="{{$jobapplications->skills}}">
                <input id="skill_proficiency" type="hidden" class="form-control resume" placeholder="75%" name="proficiency" value="{{$jobapplications->proficiency}}">
                <input type="hidden" class="form-control resume" name="cvfile" value="{{$jobapplications->cvfile}}">
                <input type="hidden" class="form-control resume" name="ward_reco" value="{{$jobapplications->ward_reco}}">
                 <input type="hidden" class="form-control resume" name="police_reco" value="{{$jobapplications->police_reco}}">
                 <input type="hidden" class="form-control resume" name="otherfile" value="{{$jobapplications->otherfile}}">
                 <input type="hidden" class="form-control resume" name="photo" value="{{$jobapplications->photo}}">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




        <div class="row">
             <div class="col-md-6">
                 <div class="table-responsive">
                 <table class="table table-bordered styled-table unicode">
                     <thead>
                        <tr>
                            <th style="font-size: 16px"><i class="fa fa-address-book" ></i> Personal Data</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                           @if($jobapplications->photo == '')
                          <td style="text-align: center;" colspan ="2">
                            <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="180px" height="180px">
                          </td>
                           
                            @else
                            <td style="text-align: center;" colspan ="2">
                                 <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->photo) }}" alt="photo" width="130px" height="130px">
                            </td>
                          
                           @endif
                        </tr>

                         <tr>
                            <td>Name<span style="padding-left: 165px">{{$jobapplications->name ? $jobapplications->name : "-" }}</span></td>
                            
                        </tr>
                         <tr>
                            <td>Parent's Name<span style="padding-left: 115px">{{$jobapplications->fName ? $jobapplications->fName : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Date of birth<span style="padding-left: 125px">{{date('d-m-Y',strtotime($jobapplications->dob))}}</span> 
                            </td>
                        </tr>
                         <tr>
                            <td>Full Nrc<span style="padding-left: 155px">{{$jobapplications->fullnrc ? $jobapplications->fullnrc : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Gender<span style="padding-left: 160px">{{$jobapplications->gender ? $jobapplications->gender : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Marital Status<span style="padding-left: 120px">{{$jobapplications->marrical_status ? $jobapplications->marrical_status : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Religion<span style="padding-left: 155px">{{$jobapplications->religion ? $jobapplications->religion : "-"}}</span></td>
                        </tr>
                    </tbody>
                 </table>
                </div>
                 <div class="table-responsive">
                 <table class="table table-bordered styled-table">
                    <thead>
                        <tr>
                            <th style="font-size: 16px"><i class="fa fa-address-card"> </i> Contact Information</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Phone<span style="padding-left: 165px">{{$jobapplications->phone ? $jobapplications->phone : "-"}}</span></td>
                            
                        </tr>
                        <tr>
                            <td>Parent's Phone<span style="padding-left: 110px">{{$jobapplications->fPhone ? $jobapplications->fPhone : "-"}}</span></td>
                        </tr>
                         <tr>
                            <td>Email <span style="padding-left: 165px">{{  $jobapplications->email ? $jobapplications->email : "-"}} </span></td>
                        </tr>
                        <tr>
                            <td>City<span style="padding-left: 180px">{{$jobapplications->city ? $jobapplications->city : "-"}}</span></td>
                        </tr>
                        <tr>
                            <td>Township<span style="padding-left: 145px">{{$jobapplications->township ? $jobapplications->township : "-"}}</span></td>
                        </tr>
                        <tr>
                            <td>Address <span style="padding-left: 155px">{{  $jobapplications->address ? $jobapplications->address : "-"}} </span></td>
                        </tr>
                       
                    </tbody>
                 </table>
                </div>
                 <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Work Experience</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Company Name<span style="padding-left: 110px">{{$jobapplications->exp_company ? $jobapplications->exp_company : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Job Position<span style="padding-left: 130px">{{$jobapplications->exp_position ? $jobapplications->exp_position : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Location<span style="padding-left: 155px">{{$jobapplications->exp_location ? $jobapplications->exp_location : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Date<span style="padding-left: 178px">{{$jobapplications->exp_date_from ? date('d-m-Y',strtotime($jobapplications->exp_date_from)) : "-"}} to {{$jobapplications->exp_date_to ? date('d-m-Y',strtotime($jobapplications->exp_date_to)) : ""}}</span></td>
                            </tr>
                           
                        </tbody>
                     </table>
               </div>
             </div>


              <div class="col-md-6">
                @if($interviewemployee->count()>0)
                @foreach($interviewemployee as $interview)
                @if($interview->step_id == 1)
                  <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> First InterView</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Remark<span style="padding-left: 160px">{{$interview->reason ? $interview->reason : "-"}}</span></td>
                                
                            </tr>
                            
                        </tbody>
                     </table>
                     </div>
                     @endif
                @if($interview->step_id == 2)

                  <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Second InterView</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Remark<span style="padding-left: 160px">{{$interview->reason ? $interview->reason : "-"}}</span></td>
                                
                            </tr>
                            
                        </tbody>
                     </table>
                     </div>
                     @endif
                    @endforeach
                     @endif

                     @if($cancelreason->count()>0)
                     @foreach($cancelreason as $cancelreasons)
                       <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Cancel Reason</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Remark<span style="padding-left: 160px">{{$cancelreasons->fcancel_reason ? $cancelreasons->fcancel_reason : "-"}}</span></td>
                                
                            </tr>
                            
                        </tbody>
                     </table>
                     </div>
                     @endforeach
                     @endif
                  <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-briefcase"> </i> Employement</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rank<span style="padding-left: 175px">{{$jobapplications->viewPosition ? $jobapplications->viewPosition->name : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Department<span style="padding-left: 135px">{{$jobapplications->viewDepartment ? $jobapplications->viewDepartment->name : "-"}}</span></td>
                            </tr>
                           
                            
                              <tr>
                                <td>isHostel<span style="padding-left: 160px">{{$jobapplications->hostel ? $jobapplications->hostel : "-"}}</span></td>
                            </tr>

                             <tr>
                                <td>Applied Date<span style="padding-left: 130px">{{$jobapplications->applied_date ? date('d-m-Y',strtotime($jobapplications->applied_date)) : "-"}}</span></td>
                            </tr>

                             <tr>
                                <td>Expected Salary<span style="padding-left: 110px">{{$jobapplications->exp_salary ? $jobapplications->exp_salary : "-"}}</span></td>
                            </tr>

                        </tbody>
                     </table>
                     </div>

                       <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-university"> </i> Education Details</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Graduation<span style="padding-left: 145px">{{$jobapplications->graduation ? $jobapplications->graduation : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>University/College<span style="padding-left: 100px">{{$jobapplications->edu ? $jobapplications->edu : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Course Title <span style="padding-left: 135px">{{  $jobapplications->course_title ? $jobapplications->course_title : "-"}} </span></td>
                            </tr>
                            <tr>
                                <td>Level<span style="padding-left: 180px">{{$jobapplications->level ? $jobapplications->level : "-"}}</span></td>
                            </tr>
                             <tr>
                                <td>Skill<span style="padding-left: 190px">{{$jobapplications->skills ? $jobapplications->skills : "-"}}</span></td>
                                
                            </tr>
                            <tr>
                                <td>Skill proficiency<span style="padding-left: 120px">{{$jobapplications->proficiency ? $jobapplications->proficiency : "-"}}</span></td>
                            </tr>
                           
                        </tbody>
                     </table>
                     </div>
                      <div class="table-responsive">
                     <table class="table table-bordered styled-table">
                        <thead>
                            <tr>
                                <th style="font-size: 16px"><i class="fa fa-file"> </i> Attach File</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{ url('uploads/jobapplicationPhoto/'.$jobapplications->cvfile) }}" target="_blank">{{$jobapplications->cvfile}}</a><span style="padding-left: 165px">   

                                      
                                         <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->ward_reco) }}" alt="photo" width="130px" height="130px">
                                        
                                 </span></td>
                                 </tr>
                                 <tr>
                                   <td style="width: 100%"> <span > <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->police_reco) }}" alt="photo" width="130px" height="130px"></span> <span style="padding-left: 100px">   

                                  <img src="{{ asset('uploads/jobapplicationPhoto/'.$jobapplications->otherfile) }}" alt="photo" width="130px" height="130px">
                                 </span></td>
                                </tr>
                           
                           
                        </tbody>
                     </table>
                     </div>

              </div>
        </div>
  
         @stop

@section('css')
  <link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
            $( "#morefilter" ).click(function(e) {
              e.preventDefault();
              if($('#adv_filter:visible').length)
                  $('#adv_filter').hide("slide", { direction: "right" }, 1000);
              else
              $('#adv_filter').show("slide", { direction: "right" }, 1000);
          });


            $("#cancel").click(function(){
               var reason = $("#reason").val(); 
                var id = $("#job_id").val(); 
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo(route("cancel")) ?>",
                    data: {'reason': reason, 'id': id},
                    success: function(data){
                     console.log(data.success);
                        // $(location).attr('href', 'jobapplication.index');
                    }
                });
                $('#myModal').modal('hide');
                // this.form.submit();
                return false;
            });

            $( "#moredatefilter" ).click(function(e) {
              e.preventDefault();
              if($('#adv_filter_date:visible').length)
                  $('#adv_filter_date').hide("slide", { direction: "right" }, 1000);
              else
              $('#adv_filter_date').show("slide", { direction: "right" }, 1000);
          });

            $(function(){
                 $("#first_date").datepicker({ dateFormat:'dd-mm-yy' });
                $("#second_date").datepicker({ dateFormat:'dd-mm-yy' });
            });
</script>
@stop
 

