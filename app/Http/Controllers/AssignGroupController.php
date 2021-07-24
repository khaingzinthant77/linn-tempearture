<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssignGroup;
use App\Branch;
use App\Department;
use App\Employee;

class AssignGroupController extends Controller
{
    public function __construct() 
    {
      $this->middleware('permission:assign-list|assign-create|assign-edit|assign-delete', ['only' => ['index','show']]);
      $this->middleware('permission:assign-create', ['only' => ['create','store']]);
      $this->middleware('permission:assign-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:assign-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departmentArr = Department::where('status',1)->orderBy('name','asc')->get();

        $departments = Department::with('groups.employees');
        if($request->dep_id!=''){
            $departments = $departments->where('id',$request->dep_id);
        }
        $count=$departments->with('employees')->get()->count();
        $departments = $departments->orderBy('name','asc')->get();
        return view('admin.group.index',compact('count','departments','departmentArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$branches = Branch::where('status',1)->get();
    	$departments = Department::where('status',1)->orderBy('name','asc')->get();

        return view('admin.group.create',compact('branches','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'group_a'=>'required',
            'group_b'=>'required',
            // 'branch_id'=>'required',
            'dep_id'=>'required',
            'a_emp_id'=>'required',
            'b_emp_id'=>'required'
        ];

        $this->validate($request,$rules);

        foreach ($request->a_emp_id as $key => $a_emp) {
             AssignGroup::create([
                'group'=>$request->group_a,
                // 'branch_id'=>$request->branch_id,
                'department_id'=>$request->dep_id,
                'emp_id'=>$a_emp
            ]);
        }

        foreach ($request->b_emp_id as $key => $b_emp) {
             AssignGroup::create([
                'group'=>$request->group_b,
                // 'branch_id'=>$request->branch_id,
                'department_id'=>$request->dep_id,
                'emp_id'=>$b_emp
            ]);
        }

        return redirect()->route('groups.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->orderBy('name','asc')->get();

        $groups = AssignGroup::with('employees')->where('department_id',$id)->get();

        return view('admin.group.edit',compact('branches','departments','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules = [
            'group_a'=>'required',
            'group_b'=>'required',
            // 'branch_id'=>'required',
            'dep_id'=>'required',
            'a_emp_id'=>'required',
            'b_emp_id'=>'required'
        ];

        $this->validate($request,$rules);

        $res = AssignGroup::where('department_id',$id)->delete();

        foreach ($request->a_emp_id as $key => $a_emp) {
             AssignGroup::create([
                'group'=>$request->group_a,
                // 'branch_id'=>$request->branch_id,
                'department_id'=>$request->dep_id,
                'emp_id'=>$a_emp
            ]);
        }

        foreach ($request->b_emp_id as $key => $b_emp) {
             AssignGroup::create([
                'group'=>$request->group_b,
                // 'branch_id'=>$request->branch_id,
                'department_id'=>$request->dep_id,
                'emp_id'=>$b_emp
            ]);
        }

    return redirect()->route('groups.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = AssignGroup::where('department_id',$id)->delete();
        return redirect()->route('groups.index')->with('success','Success');
    }

    public function get_gp_employee_data(Request $request)
    {
        $data = Employee::where('active',1)->where('dep_id',$request->dep_id);

        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
       
        $data = $data->get();
        // dd($data);
        // $data =$data->select('name',DB::raw("CONCAT(nrc_code,'/',nrc_state,'(နိုင်)',nrc_no) as full_nrc"));
        return response()->json($data);
    }
}
