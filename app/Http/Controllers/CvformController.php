<?php

namespace App\Http\Controllers;

use App\Cvform;
use App\Jobopening;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Interview;
use App\Cancelreason;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Str;

class CvformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobopenings = new Jobopening();
        $departments = Department::all();
        $jobopenings = $jobopenings->get();
        return view('frontend.home',compact('jobopenings','departments'));
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
        // dd($request->location);
        $positions = Position::all();
        $departments = Department::all();
        $nrccode = NRCCode::find($request->nrc_code);
        $nrcstate = NRCState::find($request->nrc_state);
        foreach ($positions as $key => $value) {
           if($value->name == $request->location);
           $id = $value->id;
          }
        foreach ($departments as $key => $value) {
           if($value->name == $request->department);
           $depid = $value->id;
          }
        $destinationPath = public_path() . '/uploads/jobapplicationPhoto/';
        $photo = "";
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $photo = $var;
            // dd($photo);
        }

        $police_reco_photo = "";
        if ($file = $request->file('police_reco')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $police_reco_photo = $var;
        }

        $ward_reco_photo = "";
        if ($file = $request->file('ward_reco')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $ward_reco_photo = $var;
        }


        $cvfile_photo = "";
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

        $otherfile_photo = "";
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

        $fullnrc = $nrccode->name.'/'.$nrcstate->name."(".$request->nrc_status.')'.$request->nrc;
      

        $cvform = Cvform::create([
            'name'=>$request->name,
            'nrc_code'=>$request->nrc_code,
            'nrc_state'=>$request->nrc_state,
            'nrc_status'=>$request->nrc_status,
            'nrc'=>$request->nrc,
            'fullnrc'=>$fullnrc,
            'dob'=>$request->dob,
            'edu'=>$request->education,
            'religion'=>$request->religion,
            'gender'=>$request->gender,
            'marrical_status'=>$request->marrical_status,
            'email'=>$request->email,
            'fName'=>$request->pName,
            'fPhone'=>$request->pPhone,
            'experience'=>$request->experience,
            'job'=> $request->location,
            'department'=>$request->department,
            'exp_salary'=>$request->salary,
            'hostel'=>$request->isHostel,
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
            'otherfile'=> $otherfile_photo
        ]);
    
         return redirect()->route('frontend.home')->with('success','Created successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobopenings = Jobopening::find($id);
        $departments = Department::all();
        $positions = Position::all();
        $nrccodes = NRCCode::all();
        // dd($nrccodes);
        $nrcstates = NRCState::all();
        return view('frontend.detail',compact('jobopenings','departments','positions','nrccodes','nrcstates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function edit(Cvform $cvform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
            $employees = Cvform::find($request->id);
            $updatedata = $employees->update([
                    'status'=>4,

                  ]);

            //   $cancelreason = Cancelreason::create([
            //   'emp_id'=> $request->id,
            //   'fcancel_reason'=>$request->reason,

            // ]);

            $cancelreason = Cancelreason::where('emp_id',$request->id)->get();
            // dd($cancelreason);
            if (count($cancelreason)>0) {
              // dd("Here");
               $cancelreasons = $cancelreason->update([
              'fcancel_reason'=>$request->reason,
              

            ]);
               // dd($cancelreasons);
            }else{
              // dd($cancelreasons);

               $cancelreason = Cancelreason::create([
              'emp_id'=> $request->id,
              'fcancel_reason'=>$request->reason,

            ]);
            }

            // return response()->json(['success'=>'Status change successfully.']);
           
        return redirect()->route('jobapplication.index')->with('success','Cancel Successfully');
       // dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cvform  $cvform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cvform $cvform)
    {
        //
    }

     public function selectcode(Request $request)
    {
        if($request->ajax()){
            $states = nrcstate::where('code_id',$request->nrc_code)->get();
            echo "<option value=''>Select --</opiton>";
            foreach ($states as $key => $state) {
                echo "<option value='".$state->id."'>".$state->name."</opiton>";
            }
        }
    }

    public function recallupdate(Request $request,$id)
    {
        $employees = Cvform::find($id);
        $updatedata = $employees->update([
                    'status'=>0,
                    'first_date'=>'',
                    'second_date'=>'',

                  ]);
        $interviewreacll = Interview::where('emp_id',$id)->get();
        // dd($interviewreacll);
        if (count($interviewreacll)>0) {
          $interviewreacll = $interviewreacll[0];
          $interviewreacll = $interviewreacll->delete();
        }
        
        // dd($interviewreacll);

        return redirect()->route('jobapplication.index')->with('success','Recall Successfully');
    }


}
