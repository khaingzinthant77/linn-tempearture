<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Employee;
use DB;
use Validator;

class DepartmentApiController extends Controller
{
    public function department(Request $request)
    {
        // $departments = Department::where('status',1)->get();
        // $department = Department::with('employees')->get();
        // $department = DB::table('department')
        //              ->select('department.id','department.name', 'department.dept_color','department.in_time','department.out_time','department.created_at','department.updated_at','department.status',DB::raw('count(employee.id) as total'))
        //              ->leftjoin('employee','employee.dep_id','department.id')
        //              ->groupBy('dep_id')
        //              ->get();
        // $departments = $department->where('status',1);
        $departments = new Department();
        if ($request->keyword != '') {
            $departments = $departments->where('name','like','%'.$request->keyword.'%');
        }
        $departments = $departments->where('status',1)->orderBy('id','asc')->get();
        $departmentlist = [];
            foreach ($departments as $department) { 
                $department->total= $this->getEmpCount($department->id);
                // dd($car);
                array_push($departmentlist, $department);
            }

        

        return response(['departments' => $departments,'message'=>"Successfully login",'status'=>1]);
    }

    public function department_create(Request $request)
    {
        $input = $request->all();
        $rules=[
            'dept_name'=>'required',
            'color_code'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $department = Department::create([
                'name'=>$request->dept_name,
                'color_code'=>$request->color_code,
                'status'=>1
            ]);
        return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function department_edit($id,Request $request)
    {
        $input = $request->all();
        $rules=[
            'dept_name'=>'required',
            'color_code'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $department = Department::find($id);
            $department = $department->update([
                'name'=>$request->dept_name,
                'color_code'=>$request->color_code,
            ]);
            return response(['message'=>"Successfully update",'status'=>1]);
        }
    }

    public function department_delete($id)
    {
        $department = Department::find($id);
        if ($department != null) {
            $department = $department->delete();
            return response(['message'=>"Successfully delete",'status'=>1]);
        }else{
            return response(['message'=>"Delete id does not exit!!!",'status'=>0]);
        }
    }

    public function department_activeInactive($id,Request $request)
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
            $department = Department::find($id);
            $department = $department->update([
                'status'=>$request->status
            ]);
            return response(['message'=>"Successfully",'status'=>1]);
        }
    }

    public function getEmpCount($id)
    {
        $employee_count = Employee::where('dep_id',$id)->get();
        $count = $employee_count->count();
        return $count;
    }

    public function dept_employee(Request $request)
    {
        $input = $request->all();
        $rules=[
            'dept_id'=>'required',
            'page'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
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
                $employees = $employees->where('employee.dep_id',$request->dept_id);

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
                $employees = $employees->where('employee.dep_id',$request->dept_id);

                if ($request->keyword != '') {
                    $employees = $employees->where('employee.name','like','%'.$request->keyword.'%')->orwhere('employee.phone_no','like','%'.$request->keyword.'%')->orwhere('emp_id','like','%'.$request->keyword.'%');
                }

                $employees = $employees->orderBy('employee.emp_id','asc')->get();
                return response(['employees' => $employees,'message'=>"Successfully",'status'=>1]);
            }
        }
    }
}
