<?php

namespace App\Http\Controllers;

use App\TrainingAttendance;
use App\Training;
use App\Employee;
use App\Department;
use App\Branch;
use App\Position;
use Illuminate\Http\Request;

class TrainingAttendanceController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:trainingattendance-list|trainingattendance-create|trainingattendance-edit|trainingattendance-delete', ['only' => ['index','show']]);
      $this->middleware('permission:trainingattendance-create', ['only' => ['create','store']]);
      $this->middleware('permission:trainingattendance-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:trainingattendance-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainings = new TrainingAttendance();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
         $positions = Position::All();
        $count = $trainings->get()->count();

         $trainings = $trainings->leftjoin('employee','employee.id','=','training_attendances.emp_id')
                              ->leftjoin('trainings','trainings.id','=','training_attendances.training_id')
                              ->select(
                                        'training_attendances.*',
                                        'employee.name As employee_name',
                                        'trainings.name As training_name',
                                        'employee.dep_id As department_id',
                                        'employee.branch_id As branch_id',
                                        'employee.position_id As position_id'
                                    );

        if($request->name != '') {
        $trainings = $trainings->Where('trainings.name','like','%'.$request->name.'%')->orwhere('employee.name','like','%'.$request->name.'%');
        }

         if ($request->branch_id != '') {
            $trainings = $trainings->where('employee.branch_id',$request->branch_id);
        }

         if ($request->dept_id != '') {
            $trainings = $trainings->where('employee.dep_id',$request->dept_id);
        }

        $trainings = $trainings->orderBy('training_attendances.created_at','desc')->paginate(10);
        return view('admin.training_attendance.index',compact('trainings','count','branches','departments','positions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
        return view('admin.training_attendance.create',compact('trainings'));
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
        $training = TrainingAttendance::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('training_attendance.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $training_attendances = TrainingAttendance::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_attendance.show',compact('training_attendances','trainings','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_attendances = TrainingAttendance::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_attendance.edit',compact('training_attendances','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TrainingAttendance::find($id)->update([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('training_attendance.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingAttendance  $trainingAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TrainingAttendance::find($id)->delete();
        return redirect()->route('training_attendance.index')->with('success','Success');
    }
}