<?php

namespace App\Http\Controllers;

use App\TrainingEmployee;
use App\TrainingAttendance;
use App\TestResult;
use App\Training;
use App\Department;
use App\Branch;
use App\Position;
use App\Employee;
use Illuminate\Http\Request;

class TrainingEmployeeController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:trainingemployee-list|trainingemployee-create|trainingemployee-edit|trainingemployee-delete', ['only' => ['index','show']]);
      $this->middleware('permission:trainingemployee-create', ['only' => ['create','store']]);
      $this->middleware('permission:trainingemployee-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:trainingemployee-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainings = new TrainingEmployee();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $positions = Position::All();
        $count = $trainings->get()->count();

        $trainings = $trainings->leftjoin('employee','employee.id','=','training_employees.emp_id')
                              ->leftjoin('trainings','trainings.id','=','training_employees.training_id')
                              ->select(
                                        'training_employees.*',
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

        $trainings = $trainings->orderBy('training_employees.created_at','desc')->paginate(10);
        return view('admin.training_employee.index',compact('count','trainings','branches','departments','positions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
        return view('admin.training_employee.create',compact('trainings'));
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
            'emp_id'=>'required'
        ]);
        $training = TrainingEmployee::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
        ]);
        return redirect()->route('training_emp.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $training_employees = TrainingEmployee::find($id);
        $attendance = TrainingAttendance::where('emp_id',$training_employees->emp_id)->get();
        $test_results = TestResult::where('emp_id',$training_employees->emp_id)->get();
        // dd($attendance);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_employee.show',compact('training_employees','trainings','employees','attendance','test_results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training_employees = TrainingEmployee::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.training_employee.edit',compact('training_employees','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
         $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TrainingEmployee::find($id)->update([
           'training_id'=>$request->training_id,
           'emp_id'=>$request->emp_id,
           
        ]);
        return redirect()->route('training_emp.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingEmployee  $trainingEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TrainingEmployee::find($id)->delete();
        return redirect()->route('training_emp.index')->with('success','Success');
    }
}