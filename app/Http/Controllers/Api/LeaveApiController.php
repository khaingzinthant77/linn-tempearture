<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;
use App\Employee;
use App\LeaveApplication;
use App\LeaveType;


class LeaveApiController extends Controller
{
	public function leave_type()
	{
		$leave_types = LeaveType::all();
		return response(['message'=>"Success",'status'=>1,'leave_types'=>$leave_types]);
	}

	public function leave_create(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'emp_id'=>'required',
	        'leave_type'=>'required',
	        'start_date'=>'required',
	        'end_date'=>'required',
	        'day'=>'required',
	        'apply_date'=>'required',
	        'reason'=>'required',
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
		    	$leave_application = LeaveApplication::create([
	            'emp_id'=>$request->emp_id,
	            'leavetype_id'=>$request->leave_type,
	            'halfDayType'=>$request->halfDayType ? $request->halfDayType : "",
	            'halforfull'=>$request->halforfull ? $request->halfDayType : 0,
	            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
	            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
	            'days'=>$request->day,
	            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
	            'reason'=>$request->reason,
	            'application_status'=> 0
	        ]);
		    return response(['message'=>"Success",'status'=>1]);	
	    }
	}


	public function leave_list(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required',
	        'attendance_date'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		$leave_applications = new LeaveApplication();
	    		$leave_applications = $leave_applications->leftjoin('employee','employee.id','=','leave_applications.emp_id')
	                ->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')
	                ->leftjoin('branch','branch.id','=','employee.branch_id')
	                ->leftjoin('department','department.id','=','employee.dep_id')
	                ->leftjoin('users','users.id','=','leave_applications.last_updated_by')
	                ->select(
	                    'leave_applications.*',
	                    'employee.name',
	                    'employee.photo',
	                    'leave_types.leave_type',
	                    'branch.name AS branch_name',
	                    'department.name AS dept_name',
	                    'users.name AS approve_name'
	                ); 
	             if ($request->keyword != '') {  
		            $leave_applications = $leave_applications->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $leave_applications = $leave_applications->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $leave_applications = $leave_applications->where('employee.dep_id',$request->dept_id);
		        }
		        if ($request->attendance_date != '') {
		        	$leave_applications = $leave_applications->whereDate('leave_applications.start_date','<=',date('Y-m-d',strtotime($request->attendance_date)))->whereDate('leave_applications.end_date','>=',date('Y-m-d',strtotime($request->attendance_date)));
		        	// dd($leave_applications);
		        }
		        

		        $leave_applications = $leave_applications->orderBy('leave_applications.id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'leave_applications'=>$leave_applications]);
	    	}else{
	    		$leave_applications = new LeaveApplication();
	    		$leave_applications = $leave_applications->leftjoin('employee','employee.id','=','leave_applications.emp_id')
	                ->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')
	                ->leftjoin('users','users.id','=','leave_applications.last_updated_by')
	                ->select(
	                    'leave_applications.*',
	                    'employee.name',
	                    'employee.photo',
	                    'leave_types.leave_type',
	                    'users.name'
	                );
	             if ($request->keyword != '') {
		            $leave_applications = $leave_applications->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $leave_applications = $leave_applications->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $leave_applications = $leave_applications->where('employee.dep_id',$request->dept_id);
		        }

		        if ($request->attendance_date != '') {
		        	$leave_applications = $leave_applications->whereDate('leave_applications.start_date','<=',date('Y-m-d',strtotime($request->attendance_date)))->whereDate('leave_applications.end_date','>=',date('Y-m-d',strtotime($request->attendance_date)));
		        	// dd($leave_applications);
		        }

		        $leave_applications = $leave_applications->orderBy('leave_applications.id','asc')->get();

		        return response(['message'=>"Success",'status'=>1,'leave_applications'=>$leave_applications]);
	    	}
	    }
	}

	public function leave_edit(Request $request,$id)
	{
		$input = $request->all();
	     $rules=[
	        'emp_id'=>'required',
	        'leave_type'=>'required',
	        'start_date'=>'required',
	        'end_date'=>'required',
	        'day'=>'required',
	        'apply_date'=>'required',
	        'reason'=>'required',
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{

	    		$leave_application = LeaveApplication::find($id);
		    	$leave_application = $leave_application->update([
	            // 'emp_id'=>$request->emp_id,
	            // 'leavetype_id'=>$request->leave_type,
	            // 'halfDayType'=>$request->halfDayType ? $request->halfDayType : "",
	            // 'halforfull'=>$request->halforfull ? $request->halfDayType : 0,
	            // 'start_date'=>date('Y-m-d',strtotime($request->start_date)),
	            // 'end_date'=>date('Y-m-d',strtotime($request->end_date)),
	            // 'days'=>$request->day,
	            // 'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
	            // 'reason'=>$request->reason,
	            // 'application_status'=> 0
		    		'emp_id'=>$request->emp_id,
		            'leavetype_id'=>$request->leave_type,
		            'halfDayType'=>$request->halfDayType,
		            'halforfull'=>$request->halforfull,
		            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
		            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
		            'days'=>$request->day,
		            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
		            'reason'=>$request->reason,
		            'application_status'=>0,
		            'approve_reason'=>$request->approve_reason
			        ]);
		    return response(['message'=>"Success",'status'=>1]);	
	    }
	}

	public function leave_delete($id)
	{
		$leave_applications = LeaveApplication::find($id);
		if ($leave_applications != null) {
			$leave_applications = $leave_applications->delete();
			return response(['message'=>"Success",'status'=>1]);
		}else{
			return response(['message'=>"Leave ID does not exist!!!",'status'=>0]);
		}
	}

	public function emp_leave_day(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'emp_id'=>'required',
	        'month'=>'required',
	        'year'=>'required'
	    ];
	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	$leave_days = new LeaveApplication();
	    	$leave_days = $leave_days->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')					->leftjoin('users','users.id','=','leave_applications.last_updated_by')
	    							->select(
	    								'leave_applications.*',
	    								'leave_types.leave_type',
	    								'users.name AS approve_name'
	    							);

	    	$leave_days = $leave_days->where('leave_applications.emp_id',$request->emp_id);
	    	if ($leave_days->get()->count()>0) {
	    		$leave_days = $leave_days->whereYear('leave_applications.start_date', '=', $request->year)
					              ->whereMonth('leave_applications.start_date', '=', $request->month);

	    		$leave_days = $leave_days->get();
	    		return response(['message'=>"Success",'status'=>1,'leave_days'=>$leave_days]);
	    	}else{
	    		return response(['message'=>"No Leave",'status'=>1]);
	    	}
	    }
	}
	
}	