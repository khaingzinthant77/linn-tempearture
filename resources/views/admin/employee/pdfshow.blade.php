<!DOCTYPE html>
<html>
<head>
	<title>Employee PDF</title>
</head>
<body>

   <?php 
    $currentyearbirth = date('Y');
    $currentdaybitrh = date('m');
    $currentmonthbirth = date('d');
    $joindaybirth = date('m',strtotime($show->date_of_birth));
    $joinyearbirth = date('Y',strtotime($show->date_of_birth));
    $joinmonthbirth = date('d',strtotime($show->date_of_birth));
    if($currentdaybitrh < $joindaybirth || $currentmonthbirth < $joinmonthbirth) {
      $workbirth = $currentyearbirth - $joinyearbirth;
      $workyearbirth = $workbirth ;
    }else {
      $workyearbirth = $currentyearbirth - $joinyearbirth;
    }
    ?>

   @if($show->photo == '')
      <div style="text-align: center;">
         <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" style="width: 20% !important">
      </div>
   @else
      <div style="text-align: center;">
         <img src="{{ $b64img }}" alt="{{$show->photo}}" width="100px" height="120px">
      </div>
   @endif
   <br>
 <div class="table-responsive" id="personal_table">
         <table class="table table-bordered styled-table unicode">
            <tbody>

               <tr>
                  <td>Name<span style="padding-left: 168px">{{$show->name ? $show->name : "-" }}</span></td>
               </tr>
               <tr>
                  <td>Parent's Name<span style="padding-left: 115px">{{$show->father_name ? $show->father_name : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Age<span style="padding-left:180px">{{date('d-m-Y',strtotime($show->date_of_birth))}}</span><span>({{ Carbon\Carbon::parse($show->date_of_birth)->age + 1 }}) years</span></td>
               </tr>
               <tr>
                  <td>Full Nrc<span style="padding-left: 155px">{{$show->fullnrc ? $show->fullnrc : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Gender<span style="padding-left: 160px">{{$show->gender ? $show->gender : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Marital Status<span style="padding-left: 117px">{{$show->marrical_status ? $show->marrical_status : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Race<span style="padding-left: 175px">{{$show->race ? $show->race : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Religion<span style="padding-left: 152px">{{$show->religion ? $show->religion : "-"}}</span></td>
               </tr>
            </tbody>
         </table>
      </div>

       <h3>Personal Data</h3>

       <div class="table-responsive" id="contact_table">
         <table class="table table-bordered styled-table">
            <tbody>
               <tr>
                  <td>Phone<span style="padding-left: 165px">{{$show->phone_no ? $show->phone_no : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Parent's Phone<span style="padding-left: 112px">{{$show->fPhone ? $show->fPhone : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Email <span style="padding-left: 165px">{{  $show->email ? $show->email : "-"}} </span></td>
               </tr>
               <tr>
                  <td>City<span style="padding-left: 180px">{{$show->city ? $show->city : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Township<span style="padding-left: 145px">{{$show->township ? $show->township : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Address <span style="padding-left: 150px">{{  $show->address ? $show->address : "-"}} </span></td>
               </tr>
            </tbody>
         </table>
      </div>
      <h3>Employement</h3>
       <div class="table-responsive" id="employement_table">
         <table class="table table-bordered styled-table">
            
            <tbody>
               <tr>
                  <td>Employee Id<span style="padding-left: 128px">{{$show->emp_id ? $show->emp_id : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Rank<span style="padding-left: 175px">{{$show->viewPosition->name ? $show->viewPosition->name : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Department<span style="padding-left: 135px">{{$show->viewDepartment->name ? $show->viewDepartment->name : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Branch<span style="padding-left: 165px">{{$show->ViewBranch->name ? $show->ViewBranch->name : "-"}}</span></td>
               </tr>
               <tr>
                  @php  
                  $d1 = new DateTime(date('Y-m-d',strtotime($show->join_date)));
                  $d2 = new DateTime(date("Y-m-d"));
                  $interval = $d1->diff($d2);
                  $format = $interval->format('%yY, %mM,%d D');
                  @endphp
                  <!--  ({{ $format }}) -->
                  <td>Join Date<span style="padding-left: 150px">{{ date("d-m-Y",strtotime($show->join_date)) }} ({{ $format }})</td>
               </tr>
               <tr>
                  <td>isHostel<span style="padding-left: 160px">{{$show->hostel ? $show->hostel : "-"}}</span></td>
               </tr>
               @if($show->hostel == 'Yes')
               <tr>
                  <td>Hostel Home<span style="padding-left: 130px">{{$show->viewHostel ? $show->viewHostel->name : '-' }} </span></td>
               </tr>
               <tr>
                  <td>Full Address<span style="padding-left: 135px">{{  $show->hostel_location ? $show->hostel_location : "-"}} </span></td>
               </tr>
               <tr>
                  <td>Room No<span style="padding-left: 150px">{{  $show->viewRoom ? $show->viewRoom->room_no : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Start Date<span style="padding-left: 145px">{{  $show->hostel_sdate ? $show->hostel_sdate : "-"}} </span></td>
               </tr>
               @endif
               <tr>
                  <td>Expected Salary<span style="padding-left: 110px">{{$show->exp_salary ? $show->exp_salary : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Employment Type<span style="padding-left: 90px">
                     @if($show->employment_type == '1')
                     New
                     @elseif($show->employment_type == '2')
                     Rejoin
                     @elseif($show->employment_type == '3')
                     On Join Training
                     @elseif($show->employment_type == '4')
                     Probation
                     @elseif($show->employment_type == '5')
                     Permanent
                     @endif
                     </span>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <h3>Education Detail</h3>
      <div class="table-responsive" id="education_table">
         <table class="table table-bordered styled-table">
           
            <tbody>
               <tr>
                  <td>Graduation<span style="padding-left: 145px">{{$show->graduation ? $show->graduation : "-"}}</span></td>
               </tr>
               <tr>
                  <td>University/College<span style="padding-left: 98px">{{$show->qualification ? $show->qualification : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Course Title <span style="padding-left: 135px">{{  $show->course_title ? $show->course_title : "-"}} </span></td>
               </tr>
               <tr>
                  <td>Level<span style="padding-left: 180px">{{$show->level ? $show->level : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Skill<span style="padding-left: 188px">{{$show->skills ? $show->skills : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Skill proficiency<span style="padding-left: 112px">{{$show->proficiency ? $show->proficiency : "-"}}</span></td>
               </tr>
            </tbody>
         </table>
      </div>
      <h3>Work Experience</h3>
      <div class="table-responsive" id="work_table">
         <table class="table table-bordered styled-table">

            <tbody>
               <tr>
                  <td>Company Name<span style="padding-left: 110px">{{$show->exp_company ? $show->exp_company : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Job Position<span style="padding-left: 134px">{{$show->exp_position ? $show->exp_position : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Location<span style="padding-left: 155px">{{$show->exp_location ? $show->exp_location : "-"}}</span></td>
               </tr>
               <tr>
                  <td>Date<span style="padding-left: 182px">{{$show->exp_date_from ? date('d-m-Y',strtotime($show->exp_date_from)) : "-"}} to {{$show->exp_date_to ? date('d-m-Y',strtotime($show->exp_date_to)) : ""}}</span></td>
               </tr>
            </tbody>
         </table>
      </div>
</body>
</html>