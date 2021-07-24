<?php

namespace App\Http\Controllers;

use App\LeaveApplication;
use App\Employee;
use App\Branch;
use App\Department;
use App\User;
use App\LeaveType;
use Illuminate\Http\Request;
 
class LeaveApplicationController extends Controller
{
    public function __construct() 
    {
      $this->middleware('permission:leave-list|leave-create|leave-edit|leave-delete', ['only' => ['index','show']]);
      $this->middleware('permission:leave-create', ['only' => ['create','store']]);
      $this->middleware('permission:leave-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leave_applications = new LeaveApplication();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $leave_applications = $leave_applications->leftjoin('employee','employee.id','=','leave_applications.emp_id')           
                                                ->leftjoin('leave_types','leave_types.id','=','leave_applications.leavetype_id')
                                                ->leftjoin('users','users.id','=','leave_applications.last_updated_by')
                                                ->leftjoin('branch','branch.id','=','employee.branch_id')
                                                ->leftjoin('department','department.id','=','employee.dep_id')
                                                ->select(
                                                    'leave_applications.*',
                                                    'employee.name',
                                                    'employee.photo',
                                                    'leave_types.leave_type',
                                                    'users.name',
                                                    'branch.name AS branch_name',
                                                    'department.name AS dept_name'
                                                );
        if ($request->name != '') {
            $leave_applications = $leave_applications->where('employee.name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $leave_applications = $leave_applications->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $leave_applications = $leave_applications->where('employee.dep_id',$request->dept_id);
        }
        if ($request->date != '') {
            $leave_applications = $leave_applications->where('leave_applications.start_date',date('Y-m-d',strtotime($request->date)));
        }
        $count=$leave_applications->get()->count();
        $leave_applications = $leave_applications->orderBy('created_at','desc')->paginate(10);
        // dd($count);
        return view('admin.leave_application.index',compact('count','leave_applications','branches','departments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leave_types = LeaveType::all();
        return view('admin.leave_application.create',compact('leave_types'));
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
        $this->validate($request,[
            'emp_id'=>'required',
            'leave_type'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'day'=>'required',
            'apply_date'=>'required',
            'reason'=>'required',
            'application_status'=>'required'
        ]);
        $leave_application = LeaveApplication::create([
            'emp_id'=>$request->emp_id,
            'leavetype_id'=>$request->leave_type,
            'halfDayType'=>$request->halfDayType ? $request->halfDayType : 0,
            'halforfull'=>$request->halforfull ? $request->halforfull: 0,
            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
            'days'=>$request->day,
            'last_updated_by'=>auth()->user()->id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=>$request->reason,
            'application_status'=>$request->application_status,
            'approve_reason'=>$request->approve_reason
        ]);

        return redirect()->route('leave_application.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave_application = LeaveApplication::find($id);
        return view('admin.leave_application.show',compact('leave_application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave_application = LeaveApplication::find($id);
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $leave_types = LeaveType::all();
        $employees = Employee::all();
        return view('admin.leave_application.edit',compact('leave_application','branches','departments','leave_types','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request,[
            'emp_id'=>'required',
            'leave_type'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'day'=>'required',
            'apply_date'=>'required',
            'reason'=>'required',
            'application_status'=>'required'
        ]);

        $leave_application = LeaveApplication::find($id)->update([
            'emp_id'=>$request->emp_id,
            'leavetype_id'=>$request->leave_type,
            'halfDayType'=>$request->halfDayType,
            'halforfull'=>$request->halforfull,
            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
            'days'=>$request->day,
            'last_updated_by'=>auth()->user()->id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=>$request->reason,
            'application_status'=>$request->application_status,
            'approve_reason'=>$request->approve_reason
        ]);

        return redirect()->route('leave_application.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveApplication  $leaveApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave_application = LeaveApplication::find($id)->delete();
        return redirect()->route('leave_application.index')->with('success','Success');
    }
}
