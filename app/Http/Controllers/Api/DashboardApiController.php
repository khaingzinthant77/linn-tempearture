<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use App\Position;
use Carbon\Carbon;
use DB;

class DashboardApiController extends Controller
{
    public function dashboard()
    {
        $total_employees = Employee::count();
        $total_branches = Branch::count();
        $total_departments = Department::count();

        $branches = new Branch();
        $branches = $branches->where('status',1)->orderBy('id','asc')->get();
        $branchlist = [];
            foreach ($branches as $branch) { 
                $branch->total= $this->getBranchEmpCount($branch->id);
                // dd($car);
                array_push($branchlist, $branch);
            }

        // $department = Department::with('employees')->get();
        // $department = DB::table('department')
        //              ->select('department.name','department.id','department.dept_color',DB::raw('count(employee.id) as total'))
        //              ->leftjoin('employee','employee.dep_id','department.id')
        //              ->where('employee.name','!=','')
        //              ->groupBy('dep_id')
        //              ->get();
        $departments = new Department();
        $departments = $departments->where('status',1)->orderBy('id','asc')->get();
        $departmentlist = [];
            foreach ($departments as $department) { 
                $department->total= $this->getEmpCount($department->id);
                // dd($car);
                array_push($departmentlist, $department);
            }
        $branch = Branch::with('employees')->get();
        $branchHostelArr = DB::table('branch')
                             ->select('branch.name','branch.branch_color',DB::raw('count(employee.id) as total'))
                             ->leftjoin('employee','employee.branch_id','branch.id')
                             ->groupBy('branch_id')
                             ->where('employee.hostel','Yes')
                             ->get()->toArray();

        $maleTotal = Employee::where('gender','Male')->count();
        $femaleTotal = Employee::where('gender','Female')->count();

        $hostelTotal = Employee::where('hostel','Yes')->count();
        $nothostelTotal = Employee::where('hostel','No')->count();

        $positions = Position::all();
        return response(['employee' => ['male'=>$maleTotal,'female'=>$femaleTotal],'isHostel'=>['ishostel'=>$hostelTotal,'isnothostel'=>$nothostelTotal],'branchHostel'=>$branchHostelArr,'branch'=>$branches,'department'=>$departments,'positions'=>$positions,'message'=>"Successfully login",'status'=>1]);
    }

    public function getBranchEmpCount($id)
    {
        $employee_count = Employee::where('branch_id',$id)->get();
        $count = $employee_count->count();
        // dd($count);
        return $count;
    }

    public function getEmpCount($id)
    {
        $employee_count = Employee::where('dep_id',$id)->get();
        $count = $employee_count->count();
        return $count;
    }
}
