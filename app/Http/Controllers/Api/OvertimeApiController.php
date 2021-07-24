<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;
use App\Employee;
use App\Overtime;
use App\Department;


class OvertimeApiController extends Controller
{
	public function overtime_list(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required'
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		$overtimes = new Overtime();
	    		$overtimes = $overtimes->leftjoin('employee','employee.id','=','overtime.emp_id')
	    								->leftjoin('branch','branch.id','=','employee.branch_id')
	    								->leftjoin('department','department.id','=','employee.dep_id')
	    								->select(
	    									'overtime.*',
	    									'employee.name',
	    									'employee.photo',
	    									'branch.name AS branch_name',
	    									'department.name AS dept_name'
	    								);
	    		if ($request->keyword != '') {
		            $overtimes = $overtimes->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $overtimes = $overtimes->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $overtimes = $overtimes->where('employee.dep_id',$request->dept_id);
		        }

		        if ($request->overtime_date) {
		        	$overtimes = $overtimes->where('overtime.apply_date',date('Y-m-d',strtotime($request->overtime_date)));
		        }
		       
		        $overtimes = $overtimes->orderBy('overtime.id','asc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'overtimes'=>$overtimes]);
	    	}else{
	    		$overtimes = new Overtime();
	    		$overtimes = $overtimes->leftjoin('employee','employee.id','=','overtime.emp_id')
	    								->leftjoin('branch','branch.id','=','employee.branch_id')
	    								->leftjoin('department','department.id','=','employee.dep_id')
	    								->select(
	    									'overtime.*',
	    									'employee.name',
	    									'branch.name AS branch_name',
	    									'department.name AS dept_name'
	    								);
	    		if ($request->keyword != '') {
		            $overtimes = $overtimes->where('employee.name','like','%'.$request->keyword.'%');
		        }
		        if ($request->branch_id != '') {
		            $overtimes = $overtimes->where('employee.branch_id',$request->branch_id);
		        }
		        if ($request->dept_id != '') {
		            $overtimes = $overtimes->where('employee.dep_id',$request->dept_id);
		        }
		       
		        $overtimes = $overtimes->orderBy('attendances.id','asc')->get();

		        return response(['message'=>"Success",'status'=>1,'overtimes'=>$overtimes]);
	    	}
	    }
	}


	 public function overtime_create(Request $request)
   	 {
        $input = $request->all();
        $rules=[
            'emp_id'=>'required',
            'apply_date'=>'required',
            'reason'=>'required',

        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $overtime = Overtime::create([
                'emp_id'=>$request->emp_id,
                'apply_date'=>$request->apply_date,
                'reason'=>$request->reason,
                'actionBy'=>$request->actionBy,
                'overtime_status'=>$request->overtime_status,
                'overtime_reason'=>$request->overtime_reason,

            ]);
            return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function emp_overtime_day(Request $request)
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
	    	$overtime_days = new Overtime();
	    	$overtime_days = $overtime_days->leftjoin('employee','employee.id','=','overtime.emp_id')
	    									->leftjoin('users','users.id','=','overtime.actionBy')
	    									->select(
	    										'overtime.*',
	    										'users.name'
	    									);
	    	$overtime_days = $overtime_days->where('overtime.emp_id',$request->emp_id);
	    	if ($overtime_days->get()->count()>0) {

	    		$overtime_days = $overtime_days->whereYear('overtime.apply_date', '=', $request->year)
					              ->whereMonth('overtime.apply_date', '=', $request->month);

	    		$overtime_days = $overtime_days->get();
	    		return response(['message'=>"Success",'status'=>1,'overtime_days'=>$overtime_days]);
	    	}else{
	    		return response(['message'=>"No Overtime",'status'=>1]);
	    	}
	    }
    }


}