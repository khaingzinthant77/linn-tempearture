<?php

namespace App\Http\Controllers;

use App\Overtime;
use App\Employee;
use App\Branch;
use App\Department;
use App\User;
use Illuminate\Http\Request;

class OvertimeController extends Controller
{
    public function __construct() 
    {
      $this->middleware('permission:overtime-list|overtime-create|overtime-edit|overtime-delete', ['only' => ['index','show']]);
      $this->middleware('permission:overtime-create', ['only' => ['create','store']]);
      $this->middleware('permission:overtime-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:overtime-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $overtimes = new Overtime();
       $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $count=$overtimes->get()->count();
       $overtimes = $overtimes->leftjoin('employee','employee.id','=','overtime.emp_id')
                              ->leftjoin('users','users.id','=','overtime.actionBy')
                              ->leftjoin('department','department.id','=','employee.dep_id')
                              ->leftjoin('branch','branch.id','=','employee.branch_id')
                              ->select(
                                        'overtime.*',
                                        'employee.name',
                                        'employee.photo',
                                        'users.name',
                                        'department.name As department_name',
                                        'branch.name As branch_name'
                                    );
        if ($request->name != '') {
            $overtimes = $overtimes->where('employee.name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $overtimes = $overtimes->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $overtimes = $overtimes->where('employee.dep_id',$request->dept_id);
        }
        if ($request->date != '') {
            $overtimes = $overtimes->where('overtime.apply_date',date('Y-m-d',strtotime($request->date)));
        }
        $overtimes = $overtimes->orderBy('created_at','desc')->paginate(10);
        return view('admin.overtime.index',compact('overtimes','count','branches','departments'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.overtime.create');
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
            'emp_id'=>'required',
        ];

         $this->validate($request,$rules);
        $overtime=Overtime::create([
            'emp_id'=> $request->emp_id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=> $request->reason,
            'overtime_status'=>$request->overtime_status,
            'overtime_reason'=>$request->overtime_reason,
            'actionBy'=>auth()->user()->id,
          
        ]
        );
        return redirect()->route('overtime.index')->with('success','Overtime created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function show(Overtime $overtime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtimes=Overtime::find($id);
        $employees = Employee::all();
        return view('admin.overtime.edit',compact('overtimes','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $overtimes=Overtime::find($id);
        $overtimes=$overtimes->update([
            'emp_id'=> $request->emp_id,
            'apply_date'=>date('Y-m-d',strtotime($request->apply_date)),
            'reason'=> $request->reason,
            'overtime_status'=>$request->overtime_status,
            'overtime_reason'=>$request->overtime_reason,
            'actionBy'=>auth()->user()->id,
        ]
        );
        return redirect()->route('overtime.index')->with('success','Overtime updated successfully');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Overtime  $overtime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $overtimes = Overtime::find($id);
        $overtimes->delete();
        return redirect()->route('overtime.index')->with('success','Overtime deleted successfully');;;
    }
}
