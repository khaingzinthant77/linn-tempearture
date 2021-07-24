<?php

namespace App\Http\Controllers;

use App\TestResult;
use App\Training;
use App\Department;
use App\Branch;
use App\Employee;
use App\Position;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:testresult-list|testresult-create|testresult-edit|testresult-delete', ['only' => ['index','show']]);
      $this->middleware('permission:testresult-create', ['only' => ['create','store']]);
      $this->middleware('permission:testresult-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:testresult-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainings = new TestResult();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $positions = Position::All();
        $count = $trainings->get()->count();
        $trainings = $trainings->leftjoin('employee','employee.id','=','test_results.emp_id')
                              ->leftjoin('trainings','trainings.id','=','test_results.training_id')
                              ->select(
                                        'test_results.*',
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

        $trainings = $trainings->orderBy('test_results.created_at','desc')->paginate(10);
        return view('admin.test_result.index',compact('trainings','count','branches','departments','positions'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainings =  Training::all();
       return view('admin.test_result.create',compact('trainings'));
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
        $test_result = TestResult::create([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'test_date'=>date('Y-m-d',strtotime($request->test_date)),
            'marks'=>$request->marks,
            'remark'=>$request->remark
        ]);
        return redirect()->route('test_result.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $test_result = TestResult::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.test_result.show',compact('test_result','trainings','employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test_result = TestResult::find($id);
        $trainings = Training::all();
        $employees = Employee::all();
        return view('admin.test_result.edit',compact('test_result','trainings','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'emp_id'=>'required'
        ]);
        $trainings = TestResult::find($id)->update([
            'training_id'=>$request->training_id,
            'emp_id'=>$request->emp_id,
            'att_date'=>date('Y-m-d',strtotime($request->att_date)),
            'status'=>$request->status,
            'remark'=>$request->remark
        ]);
        return redirect()->route('test_result.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TestResult  $testResult
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = TestResult::find($id)->delete();
        return redirect()->route('test_result.index')->with('success','Success');
    }
}