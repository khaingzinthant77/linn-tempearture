<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use App\Branch;
use App\Department;
use App\Position;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct() 
    {
      $this->middleware('permission:attendance-list|attendance-create|attendance-edit|attendance-delete', ['only' => ['index','show']]);
      $this->middleware('permission:attendance-create', ['only' => ['create','store']]);
      $this->middleware('permission:attendance-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:attendance-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attendances = new Attendance();
        $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                    ->leftjoin('branch','branch.id','=','employee.branch_id')
                                    ->leftjoin('department','department.id','=','employee.dep_id')
                                    ->leftjoin('position','position.id','=','employee.position_id')
                                     ->leftjoin('users','users.id','=','attendances.last_updated_by')
                                    ->select(
                                        'attendances.*', 
                                        'employee.name',
                                        'employee.photo',
                                        'branch.name AS branch_name',
                                        'department.name AS dept_name',
                                        'position.name AS position_name',
                                        'users.name AS user_name'
                                    );
        if ($request->name != '') {
            $attendances = $attendances->where('employee.name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $attendances = $attendances->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $attendances = $attendances->where('employee.dep_id',$request->dept_id);
        }
        if ($request->attendance_date != '') {
            $attendances = $attendances->whereDate('attendances.date',date('Y-m-d',strtotime($request->attendance_date)));
            // $attendances_date = date('Y-m-d',strtotime($request->attendance_date));
        }else{
             $attendances = $attendances->whereDate('attendances.date',date('Y-m-d'));
        }
        $count = $attendances->get()->count();

        $attendances = $attendances->orderBy('attendances.created_at','desc')->paginate(10);
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        return view('admin.attendance.index',compact('count','attendances','branches','departments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attendance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $attendance = Attendance::create([
            'emp_id'=>$request->emp_id,
            'clock_in'=>$request->clock_in,
            'clock_out'=>$request->clock_out,
            'date'=>date('Y-m-d',strtotime($request->date)),
            'out_date'=>date('Y-m-d',strtotime($request->out_date)),
            'attendance_status'=>$request->attendance_status,
            'clockin_ip_address'=>$request->clockin_ip_address,
            'colckout_ip_address'=>$request->colckout_ip_address,
            'working_from'=>$request->working_from,
            'note'=>$request->note,
            'is_late'=>$request->is_late,
            'reason'=>$request->reason,
            'last_updated_by'=>auth()->user()->id,
        ]);
        return redirect()->route('attendance.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);
        return view('admin.attendance.show',compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        $employees = Employee::all();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        return view('admin.attendance.edit',compact('attendance','employees','branches','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $attendance = Attendance::find($id)->update([
            'emp_id'=>$request->emp_id,
            'clock_in'=>$request->clock_in,
            'clock_out'=>$request->clock_out,
            'date'=>date('Y-m-d',strtotime($request->date)),
            'out_date'=>date('Y-m-d',strtotime($request->out_date)),
            'attendance_status'=>$request->attendance_status,
            'clockin_ip_address'=>$request->clockin_ip_address,
            'colckout_ip_address'=>$request->colckout_ip_address,
            'working_from'=>$request->working_from,
            'note'=>$request->note,
            'is_late'=>$request->is_late,
            'reason'=>$request->reason,
            'last_updated_by'=>auth()->user()->id,
        ]);
        return redirect()->route('attendance.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id)->delete();
        return redirect()->route('attendance.index')->with('success','Success');
    }
}
