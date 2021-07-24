<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DB;
use Validator;
use App\Employee;


class BranchApiController extends Controller
{
    public function branch(Request $request)
    {
        $branches = new Branch();
        if ($request->keyword != '') {
            $branches = $branches->where('name','like','%'.$request->keyword.'%');
        }
        $branches = $branches->where('status',1)->orderBy('id','asc')->get();
        $branchlist = [];
            foreach ($branches as $branch) { 
                $branch->total= $this->getEmpCount($branch->id);
                // dd($car);
                array_push($branchlist, $branch);
            }
        

        return response(['branches' => $branches,'message'=>"Successfully login",'status'=>1]);
    }

    public function branch_create(Request $request)
    {
        $input = $request->all();
        $rules=[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_latitude'=>'required',
            'branch_longitude'=>'required',
            'branch_color'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $branch = Branch::create([
                'name'=>$request->branch_name,
                'phone'=>$request->branch_phone,
                'latitude'=>$request->branch_latitude,
                'longitude'=>$request->branch_longitude,
                'branch_color'=>$request->branch_color,
                'status'=>1
            ]);
            return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function branch_edit($id,Request $request)
    {
        // dd($id);
        $input = $request->all();
        $rules=[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_latitude'=>'required',
            'branch_longitude'=>'required',
            'branch_color'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{

            $branch = Branch::find($id);
            $branch = $branch->update([
                'name'=>$request->branch_name,
                'phone'=>$request->branch_phone,
                'latitude'=>$request->branch_latitude,
                'longitude'=>$request->branch_longitude,
                'branch_color'=>$request->branch_color
            ]);
            return response(['message'=>"Successfully update",'status'=>1]);
        }
    }

    public function branch_delete($id)
    {
        $branch = Branch::find($id);
        if ($branch != null) {
            $branch = $branch->delete();
            return response(['message'=>"Successfully delete",'status'=>1]);
        }else{
            return response(['message'=>"Delete id does not exit!!!",'status'=>0]);
        }
    }

    public function active_inactive($id,Request $request)
    {
        $input = $request->all();
        $rules=[
            'status'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Status Required",'status'=>0]);
        }else{
            $branch = Branch::find($id);
            $branch = $branch->update([
                'status'=>$request->status
            ]);
            return response(['message'=>"Successfully",'status'=>1]);
        }
    }

    public function getEmpCount($id)
    {
        $employee_count = Employee::where('branch_id',$id)->get();
        $count = $employee_count->count();
        // dd($count);
        return $count;
    }

    public function branch_employee(Request $request)
    {
        $input = $request->all();
        $rules=[
            'branch_id'=>'required',
            'page'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Status Required",'status'=>0]);
        }else{
            if ($request->page != 0) {
                $employees = new Employee();
                $employees = $employees->leftJoin('branch','branch.id','=','employee.branch_id')
                                     ->leftJoin('department','department.id','=','employee.dep_id')
                                     ->leftJoin('position','position.id','=','employee.position_id')
                                     ->leftJoin('nrccode','nrccode.id','=','employee.nrc_code')
                                     ->leftJoin('nrcstate','nrcstate.id','=','employee.nrc_state')
                                     ->leftJoin('hostel','hostel.id','=','employee.home_no')
                                     ->select(
                                        'employee.id',
                                        'employee.name',
                                        'employee.gender',
                                        'employee.date_of_birth',
                                        'nrccode.id AS nrccode_id',
                                        'nrccode.name AS nrc_code',
                                        'nrcstate.id AS nrcstate_id',
                                        'nrcstate.name AS nrc_state',
                                        'employee.nrc_status',
                                        'employee.nrc',
                                        'employee.fullnrc',
                                        'employee.email',
                                        'employee.father_name',
                                        'employee.race',
                                        'employee.religion',
                                        'employee.marrical_status',
                                        'employee.photo',
                                        'employee.phone_no',
                                        'employee.fPhone',
                                        'employee.address',
                                        'employee.city',
                                        'employee.township',
                                        'employee.graduation',
                                        'employee.course_title',
                                        'employee.qualification',
                                        'employee.level',
                                        'employee.degree',
                                        'employee.exp_company',
                                        'employee.exp_date_from',
                                        'employee.exp_date_to',
                                        'employee.exp_location',
                                        'employee.exp_position',
                                        'employee.emp_id',
                                        'branch.id AS branch_id',
                                        'branch.name AS branch_name',
                                        'department.id AS department_id',
                                        'department.name AS dept_name',
                                        'position.name AS position',
                                        'employee.hostel',
                                        'employee.hostel_sdate',
                                        'employee.hostel_location',
                                        'employee.home_no',
                                        'employee.room_no',
                                        'employee.exp_salary',
                                        'employee.skills',
                                        'employee.proficiency',
                                        'employee.cvfile',
                                        'employee.ward_reco',
                                        'employee.police_reco',
                                        'employee.otherfile',
                                        'hostel.name AS hostel_name',
                                        'employee.join_date'
                                     );
                $employees = $employees->where('employee.branch_id',$request->branch_id);

                if ($request->keyword != '') {
                    $employees = $employees->where('employee.name','like','%'.$request->keyword.'%')->orwhere('employee.phone_no','like','%'.$request->keyword.'%')->orwhere('emp_id','like','%'.$request->keyword.'%');
                }

                $employees = $employees->orderBy('employee.emp_id','asc')->limit(10)->paginate(10);
                return response(['employees' => $employees,'message'=>"Successfully",'status'=>1]);
            }else{
                $employees = new Employee();
                $employees = $employees->leftJoin('branch','branch.id','=','employee.branch_id')
                                     ->leftJoin('department','department.id','=','employee.dep_id')
                                     ->leftJoin('position','position.id','=','employee.position_id')
                                     ->leftJoin('nrccode','nrccode.id','=','employee.nrc_code')
                                     ->leftJoin('nrcstate','nrcstate.id','=','employee.nrc_state')
                                     ->leftJoin('hostel','hostel.id','=','employee.home_no')
                                     ->select(
                                        'employee.id',
                                        'employee.name',
                                        'employee.gender',
                                        'employee.date_of_birth',
                                        'nrccode.id AS nrccode_id',
                                        'nrccode.name AS nrc_code',
                                        'nrcstate.id AS nrcstate_id',
                                        'nrcstate.name AS nrc_state',
                                        'employee.nrc_status',
                                        'employee.nrc',
                                        'employee.fullnrc',
                                        'employee.email',
                                        'employee.father_name',
                                        'employee.race',
                                        'employee.religion',
                                        'employee.marrical_status',
                                        'employee.photo',
                                        'employee.phone_no',
                                        'employee.fPhone',
                                        'employee.address',
                                        'employee.city',
                                        'employee.township',
                                        'employee.graduation',
                                        'employee.course_title',
                                        'employee.qualification',
                                        'employee.level',
                                        'employee.degree',
                                        'employee.exp_company',
                                        'employee.exp_date_from',
                                        'employee.exp_date_to',
                                        'employee.exp_location',
                                        'employee.exp_position',
                                        'employee.emp_id',
                                        'branch.id AS branch_id',
                                        'branch.name AS branch_name',
                                        'department.id AS department_id',
                                        'department.name AS dept_name',
                                        'position.name AS position',
                                        'employee.hostel',
                                        'employee.hostel_sdate',
                                        'employee.hostel_location',
                                        'employee.home_no',
                                        'employee.room_no',
                                        'employee.exp_salary',
                                        'employee.skills',
                                        'employee.proficiency',
                                        'employee.cvfile',
                                        'employee.ward_reco',
                                        'employee.police_reco',
                                        'employee.otherfile',
                                        'hostel.name AS hostel_name',
                                        'employee.join_date'
                                     );
                $employees = $employees->where('employee.branch_id',$request->branch_id);

                if ($request->keyword != '') {
                    $employees = $employees->where('employee.name','like','%'.$request->keyword.'%')->orwhere('employee.phone_no','like','%'.$request->keyword.'%')->orwhere('emp_id','like','%'.$request->keyword.'%');
                }

                $employees = $employees->orderBy('employee.emp_id','asc')->get();
                return response(['employees' => $employees,'message'=>"Successfully",'status'=>1]);
            }
        }
    }


}
	