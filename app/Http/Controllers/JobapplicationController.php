<?php

namespace App\Http\Controllers;

use App\Cvform;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Employee;
use App\Jobopening;
use App\Interview;
use App\Cancelreason;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use DB;
use Validator;

class JobapplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->secondinv_fromdate , $request->secondinv_todate);
        $jobapplications = new Cvform();
        $departments = Department::all();
        $positions = Position::all();
        if($request->name != '') {
        $jobapplications = $jobapplications->Where('name','like','%'.$request->name.'%');
        }
        if ($request->status != '') {
            $jobapplications = $jobapplications->where('status',$request->status);
        }

        if ($request->finterview_date != '' && $request->sinterview_date != '') {
            $startDate = date('m/d/Y', strtotime($request->finterview_date));
            $endDate = date('m/d/Y', strtotime($request->sinterview_date));
            $jobapplications = Cvform::whereBetween('cvform.first_date',[$startDate,$endDate]);
            
        }

         if ($request->secondinv_todate != '' && $request->secondinv_fromdate != '') {
            $startDate = date('m/d/Y', strtotime($request->secondinv_fromdate));
            $endDate = date('m/d/Y', strtotime($request->secondinv_todate));
            $jobapplications = Cvform::whereBetween('cvform.second_date',[$startDate,$endDate]);
            // dd($jobapplications->get());
            // dd($customers);
        }
        // dd($jobapplications);

        $count = $jobapplications->get()->count();
        $jobapplications = $jobapplications->orderBy('created_at','desc')->paginate(10);
        return view('admin.jobapplication.index',compact('jobapplications','departments','positions','count'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
         $rules = [
                    'name'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
             DB::beginTransaction();
             try{

                $departments = Department::all();
                    $positions = Position::all();
                    $destinationPath = public_path() . '/uploads/employeePhoto/';
                    $policePath = public_path() . '/uploads/policestationrecomPhoto/';
                    $wardPath = public_path() . '/uploads/wardrecoPhoto/';
                    $attachPath = public_path() . '/uploads/attachfile';
                    $photo = ($request->photo != '') ? $request->photo : null;
                    //upload image
                    if ($file = $request->file('photo')) {
                        $extension = $file->getClientOriginalExtension();
                        $var = Str::random(32) . '.' . $extension;
                        $file->move($destinationPath, $var);
                        $photo = $var;
                    }

                     $police_reco_photo = ($request->police_reco != '') ? $request->police_reco : $request->police_reco;
                     
                    if ($file = $request->file('police_reco')) {
                        $police_reco = $request->file('police_reco');
                        $ext = '.'.$request->police_reco->getClientOriginalExtension();
                        $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->police_reco->getClientOriginalName());
                        $file->move($policePath, $fileName);
                        $police_reco_photo = $fileName;
                    }

                    $ward_reco_photo =  ($request->ward_reco != '') ? $request->ward_reco : $request->ward_reco;
                    if ($file = $request->file('ward_reco')) {
                       $ward_reco = $request->file('ward_reco');
                        $ext = '.'.$request->ward_reco->getClientOriginalExtension();
                        $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->ward_reco->getClientOriginalName());
                        $file->move($wardPath, $fileName);
                        $ward_reco_photo = $fileName;
                    }


                    $cvfile_photo = ($request->cvfile != '') ? $request->cvfile : $request->cvfile;
                    if ($file = $request->file('cvfile')) {
                        $cvfile = $request->file('cvfile');
                        $ext = '.'.$request->cvfile->getClientOriginalExtension();
                        $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->cvfile->getClientOriginalName());
                        $file->move($attachPath, $fileName);
                        $cvfile_photo = $fileName;
                        // dd($cvfile_photo);
                        // $extension = $file->getClientOriginalExtension();
                        // $var = Str::random(32) . '.' .


                        $extension;
                        // $file->move($destinationPath, $var);
                        // $cvfile_photo = $var;
                        // dd($cvfile_photo);
                    }

                    $otherfile_photo = ($request->otherfile != '') ? $request->otherfile : $request->otherfile;
                    if ($file = $request->file('otherfile')) {
                       $otherfile = $request->file('otherfile');
                        $ext = '.'.$request->otherfile->getClientOriginalExtension();
                        $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->otherfile->getClientOriginalName());
                        $file->move($attachPath, $fileName);
                        $otherfile_photo = $fileName;
                    }


                    // foreach ($departments as $key => $value) {
                    //     if ($value->name == $request->department) {

                    //        $dep_id = $value->id ;
                    //     }
                    // }
                    // foreach ($positions as $key => $value) {
                    //    if ($value->name == $request->location) {
                    //      $pos_id = $value->id;
                    //      // dd($pos_id);
                    //    }
                    // }
                    $max = Employee::max('emp_id');
                    $items = (string)$max;
                    // dd($items);
                    $max_year = substr($items, 0, 2);
                    $max_count = substr($items,-2);
                    $max_middle = substr($items,-4);
                    $max_middle_month = substr($max_middle, 0, 2);
                    // dd($max_count);
                    $date = date('Y-m-d');
                    $month = date('m');
                    $joinyear = date('y');
                    $joinmonth = date('m');
                    $joinday = '01';
                    // $joindate = $joinyear . $joinmonth . $joinday;

                    if($max_year == $joinyear && $max_middle_month == $joinmonth){
                        $join_count = sprintf("%02d", ++$max_count);
                        $joindate = $joinyear . $joinmonth . $join_count;
                    
                    }else{
                        $joindate = $joinyear . $joinmonth . $joinday;
                    }
                   


                     $employee=Employee::create([
                        'emp_id'=>$joindate,
                        'branch_id'=>1,
                        'dep_id'=>$request->department,
                        'position_id'=>$request->location,
                        'name'=> $request->name,
                        'gender'=>$request->gender,
                        'marrical_status'=>$request->marrical_status,
                        'father_name'=>$request->fName,
                        'phone_no'=>$request->phone,
                        'nrc_code'=>$request->nrc_code,
                        'nrc_state'=>$request->nrc_state,
                        'nrc_status'=>$request->nrc_status,
                        'nrc'=>$request->nrc,
                        'fullnrc'=>$request->fullnrc,
                        'date_of_birth'=>$request->dob,
                        'join_date'=>$date ,
                        'join_month'=>$month,
                        'address'=>$request->address,
                        'city'=>$request->city,
                        'township'=>$request->township,
                        'qualification'=>$request->education,
                        'photo'=>$photo,
                        'religion'=>$request->religion,
                        'email'=>$request->email,
                        'fPhone'=>$request->fPhone,
                        'experience'=>$request->experience,
                        'exp_salary'=>$request->salary,
                        'hostel'=>$request->isHostel,
                        'police_reco'=>$police_reco_photo,
                        'ward_reco'=>$ward_reco_photo,
                        'cvfile'=>$cvfile_photo,
                        'otherfile'=> $otherfile_photo,
                    ]
                    );

                    $employees = Cvform::find($request->emp_id);
                    $updatedata = $employees->update([
                            'status'=>3,
                          ]);

                     DB::commit();

             }catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('jobapplication.index')->with('success','Successfully');
             }
            return redirect()->route('jobapplication.index')->with('success','Successfully');

        }else{
            return redirect()->route('jobapplication.show');
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departments = Department::all();
        $positions = Position::all();
        $nrccodes = NRCCode::all();
        $nrcstates = NRCState::all(); 
        $jobapplications = Cvform::find($id);
        $interviewemployee = Interview::where('emp_id',$id)->get();
        $cancelreason = Cancelreason::where('emp_id',$id)->get();
        // dd($interviewemployee);
        return view('admin.jobapplication.show',compact('departments','positions','jobapplications','nrccodes','nrcstates','interviewemployee','cancelreason'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
               // dd($request->fPhone);
                $jobapplications = Cvform::find($id);
                $destinationPath = public_path() . '/uploads/jobapplicationPhoto/';
                $photo =($request->photo != '') ? $request->photo : null;
                if ($file = $request->file('myPhoto')) {
                    $extension = $file->getClientOriginalExtension();
                    $var = Str::random(32) . '.' . $extension;
                    $file->move($destinationPath, $var);
                    $photo = $var;
                    // dd($photo);
                }

                $police_reco_photo = ($request->police_reco != '') ? $request->police_reco : $request->police_reco;
                if ($file = $request->file('police_reco')) {
                    $extension = $file->getClientOriginalExtension();
                    $var = Str::random(32) . '.' . $extension;
                    $file->move($destinationPath, $var);
                    $police_reco_photo = $var;
                }

                $ward_reco_photo =  ($request->ward_reco != '') ? $request->ward_reco : $request->ward_reco;
                if ($file = $request->file('ward_reco')) {
                    $extension = $file->getClientOriginalExtension();
                    $var = Str::random(32) . '.' . $extension;
                    $file->move($destinationPath, $var);
                    $ward_reco_photo = $var;
                }


                $cvfile_photo = ($request->cvfile != '') ? $request->cvfile : $request->cvfile;
                if ($file = $request->file('cvfile')) {
                    $name = $file->getClientOriginalName();
                    $destinationPath = public_path('/uploads/jobapplicationPhoto/');
                    $file->move($destinationPath, $name);
                    $cvfile_photo=$name;
                    // dd($cvfile_photo);
                    // $extension = $file->getClientOriginalExtension();
                    // $var = Str::random(32) . '.' . $extension;
                    // $file->move($destinationPath, $var);
                    // $cvfile_photo = $var;
                    // dd($cvfile_photo);
                }

                $otherfile_photo = ($request->otherfile != '') ? $request->otherfile : $request->otherfile;
                if ($file = $request->file('otherfile')) {
                    $extension = $file->getClientOriginalExtension();
                    $var = Str::random(32) . '.' . $extension;
                    $file->move($destinationPath, $var);
                    $otherfile_photo = $var;
                }

                $degree_photo = "";
                if ($file = $request->file('degree')) {
                    $extension = $file->getClientOriginalExtension();
                    $var = Str::random(32) . '.' . $extension;
                    $file->move($destinationPath, $var);
                    $degree_photo = $var;
                }
                $jobapplications =  $jobapplications->update([
                    'name'=>$request->name,
                    'nrc_code'=>$request->nrc_code,
                    'nrc_state'=>$request->nrc_state,
                    'nrc_status'=>$request->nrc_status,
                    'nrc'=>$request->nrc,
                    'fullnrc'=>$request->fullnrc,
                    'dob'=>$request->dob,
                    'edu'=>$request->education,
                    'religion'=>$request->religion,
                    'gender'=>$request->gender,
                    'marrical_status'=>$request->marrical_status,
                    'email'=>$request->email,
                    'fName'=>$request->fName,
                    'fPhone'=>$request->fPhone,
                    'experience'=>$request->experience,
                    'job'=> $request->location,
                    'department'=>$request->department,
                    'exp_salary'=>$request->salary,
                    'hostel'=>$request->hostel,
                    'applied_date'=>$request->appliedDate,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'signature'=>$request->signed,
                    'photo'=>$photo,
                    'city'=>$request->city,
                    'township'=>$request->township,
                    'graduation'=>$request->graduation,
                    'degree'=>$degree_photo,
                    'level'=>$request->level,
                    'course_title'=>$request->course_title,
                    'exp_company'=>$request->exp_company,
                    'exp_position'=>$request->exp_position,
                    'exp_location'=>$request->exp_location,
                    'exp_date_from'=>$request->exp_date_from,
                    'exp_date_to'=>$request->exp_date_to,
                    'skills'=>$request->skills,
                    'proficiency'=>$request->proficiency,
                    'police_reco'=>$police_reco_photo,
                    'ward_reco'=>$ward_reco_photo,
                    'cvfile'=>$cvfile_photo,
                    'otherfile'=> $otherfile_photo,
                    'first_date'=>$request->first_date,
                    'second_date'=>$request->second_date,
                ]);
               return redirect()->route('jobapplication.index')->with('success','Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function jobList()
    {
        $jobopenings = new Jobopening();
        $jobopenings = $jobopenings->get();
      return view('frontend.joblist',compact('jobopenings'));
    }

    public function jobListdetail($id)
    {
        // dd($id);
        $jobopenings = Jobopening::find($id);
        return view('frontend.joblistdetail',compact('jobopenings'));
    }

    public function jobabout()
    {
       return view('frontend.about');
    }

    public function jobcontact()
    {
        return view('frontend.contactus');
    }
}
