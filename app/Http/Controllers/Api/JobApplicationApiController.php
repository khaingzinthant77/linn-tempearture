<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cvform;
use App\Department;
use App\Position;
use App\NRCCode;
use App\NRCState;
use App\Interview;
use DB;
use Validator;


class JobApplicationApiController extends Controller
{
	public function job_application_list(Request $request)
	{
		$input = $request->all();
        // dd($input);
             $rules=[
                'page'=>'required'
            ];

            $validator = Validator::make($input, $rules);

             if ($validator->fails()) {
                $messages = $validator->messages();
                return response()->json(['message'=>"Error",'status'=>0]);
            }else{
            	if ($request->page != 0) {
            		$cvforms = new CvForm();
            		$cvforms = $cvforms->leftJoin('department','department.id','=','cvform.department')
            						   ->leftJoin('position','position.id','=','cvform.job')
            						   ->leftJoin('nrccode','nrccode.id','=','cvform.nrc_code')
            						   ->leftJoin('nrcstate','nrcstate.id','=','cvform.nrc_state')

            						   ->select(
            						   		'cvform.id',
            						   		'cvform.name',
            						   		'nrccode.id AS nrc_code_id',
            						   		'nrccode.name AS nrc_code',
            						   		'nrcstate.id AS nrc_state_id',
            						   		'nrcstate.name AS nrc_state',
            						   		'cvform.nrc_status',
                                            'cvform.status',
            						   		'cvform.nrc',
            						   		'cvform.fullnrc',
            						   		'cvform.dob',
            						   		'cvform.edu',
            						   		'cvform.religion',
            						   		'cvform.gender',
            						   		'cvform.marrical_status',
            						   		'cvform.email',
            						   		'cvform.fName',
            						   		'cvform.fPhone',
            						   		'cvform.experience',
            						   		'position.name AS position_name',
            						   		'department.name AS department_name',
            						   		'cvform.exp_salary',
            						   		'cvform.hostel',
            						   		'cvform.applied_date',
            						   		'cvform.address',
            						   		'cvform.phone',
            						   		'cvform.photo',
            						   		'cvform.signature',
            						   		'cvform.status',
            						   		'cvform.city',
            						   		'cvform.township',
            						   		'cvform.graduation',
            						   		'cvform.degree',
            						   		'cvform.level',
            						   		'cvform.course_title',
            						   		'cvform.exp_company',
            						   		'cvform.exp_position',
            						   		'cvform.exp_location',
            						   		'cvform.exp_date_from',
            						   		'cvform.exp_date_to',
            						   		'cvform.skills',
            						   		'cvform.proficiency',
            						   		'cvform.police_reco',
            						   		'cvform.ward_reco',
            						   		'cvform.cvfile',
            						   		'cvform.otherfile',
            						   		'cvform.first_date',
            						   		'cvform.second_date'
            						   );
            		if ($request->keyword != '') {
                        $cvforms = $cvforms->where('cvform.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->job_status != '') {
                    	$cvforms = $cvforms->where('cvform.status',$request->job_status);
                    }
            		$cvforms = $cvforms->orderBy('cvform.id','asc')->limit(10)->paginate(10);
                    return response(['joblists' => $cvforms,'message'=>"Successfully",'status'=>1]);
            	}else{
            		$cvforms = new CvForm();
            		$cvforms = $cvforms->leftJoin('department','department.id','=','cvform.department')
            						   ->leftJoin('position','position.id','=','cvform.job')
            						   ->leftJoin('nrccode','nrccode.id','=','cvform.nrc_code')
            						   ->leftJoin('nrcstate','nrcstate.id','=','cvform.nrc_state')
            						   ->select(
            						   		'cvform.id',
            						   		'cvform.name',
            						   		'nrccode.id AS nrc_code_id',
            						   		'nrccode.name AS nrc_code',
            						   		'nrcstate.id AS nrc_state_id',
            						   		'nrcstate.name AS nrc_state',
            						   		'cvform.nrc_status',
            						   		'cvform.nrc',
            						   		'cvform.fullnrc',
            						   		'cvform.dob',
            						   		'cvform.edu',
                                            'cvform.status',
            						   		'cvform.religion',
            						   		'cvform.gender',
            						   		'cvform.marrical_status',
            						   		'cvform.email',
            						   		'cvform.fName',
            						   		'cvform.fPhone',
            						   		'cvform.experience',
            						   		'position.name AS position',
            						   		'department.name AS department',
            						   		'cvform.exp_salary',
            						   		'cvform.hostel',
            						   		'cvform.applied_date',
            						   		'cvform.address',
            						   		'cvform.phone',
            						   		'cvform.photo',
            						   		'cvform.signature',
            						   		'cvform.status',
            						   		'cvform.city',
            						   		'cvform.township',
            						   		'cvform.graduation',
            						   		'cvform.degree',
            						   		'cvform.level',
            						   		'cvform.course_title',
            						   		'cvform.exp_company',
            						   		'cvform.exp_position',
            						   		'cvform.exp_location',
            						   		'cvform.exp_date_from',
            						   		'cvform.exp_date_to',
            						   		'cvform.skills',
            						   		'cvform.proficiency',
            						   		'cvform.police_reco',
            						   		'cvform.ward_reco',
            						   		'cvform.cvfile',
            						   		'cvform.otherfile',
            						   		'cvform.first_date',
            						   		'cvform.second_date'
            						   );
            		if ($request->keyword != '') {
                        $cvforms = $cvforms->where('cvform.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->job_status != '') {
                    	$cvforms = $cvforms->where('cvform.status',$request->job_status);
                    }
            		$cvforms = $cvforms->orderBy('cvform.id','asc')->get();
                    return response(['joblists' => $cvforms,'message'=>"Successfully",'status'=>1]);
            	}
            }
	}

	public function job_application_detail($id)
	{
		$cvforms = new CvForm();
		$cvforms = $cvforms->leftJoin('department','department.id','=','cvform.department')
						   ->leftJoin('position','position.id','=','cvform.job')
						   ->leftJoin('nrccode','nrccode.id','=','cvform.nrc_code')
						   ->leftJoin('nrcstate','nrcstate.id','=','cvform.nrc_state')
						   ->select(
						   		'cvform.id',
						   		'cvform.name',
						   		'nrccode.id AS nrc_code_id',
						   		'nrccode.name AS nrc_code',
						   		'nrcstate.id AS nrc_state_id',
						   		'nrcstate.name AS nrc_state',
						   		'cvform.nrc_status',
						   		'cvform.nrc',
						   		'cvform.fullnrc',
						   		'cvform.dob',
						   		'cvform.edu',
						   		'cvform.religion',
						   		'cvform.gender',
						   		'cvform.marrical_status',
						   		'cvform.email',
						   		'cvform.fName',
						   		'cvform.fPhone',
                                'cvform.status',
						   		'cvform.experience',
						   		'position.name AS position',
						   		'department.name AS department',
						   		'cvform.exp_salary',
						   		'cvform.hostel',
						   		'cvform.applied_date',
						   		'cvform.address',
						   		'cvform.phone',
						   		'cvform.photo',
						   		'cvform.signature',
						   		'cvform.status',
						   		'cvform.city',
						   		'cvform.township',
						   		'cvform.graduation',
						   		'cvform.degree',
						   		'cvform.level',
						   		'cvform.course_title',
						   		'cvform.exp_company',
						   		'cvform.exp_position',
						   		'cvform.exp_location',
						   		'cvform.exp_date_from',
						   		'cvform.exp_date_to',
						   		'cvform.skills',
						   		'cvform.proficiency',
						   		'cvform.police_reco',
						   		'cvform.ward_reco',
						   		'cvform.cvfile',
						   		'cvform.otherfile',
						   		'cvform.first_date',
						   		'cvform.second_date'
						   );
		$cvforms = $cvforms->where('cvform.id',$id)->get();
        $interview_steps = Interview::where('emp_id',$id)->get();
        if ($cvforms->count()>0) {
            $cvforms = $cvforms[0];
            return response(['job_detail' => $cvforms,"interview_steps"=>$interview_steps,'message'=>"Successfully",'status'=>1]); 
        }else{
            return response(['message'=>"Job id does not exit!!!",'status'=>0]); 
        }
	}
}