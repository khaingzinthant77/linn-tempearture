<?php

namespace App\Http\Controllers;

use App\Offday;
use App\Employee;
use App\Branch;
use App\Department;
use App\Position;
use App\User;
use App\Exports\OffdayExport;
use App\Imports\OffdayImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DateTime;
use File;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class OffdayController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:offday-list|offday-create|offday-edit|offday-delete', ['only' => ['index','show']]);
      $this->middleware('permission:offday-create', ['only' => ['create','store']]);
      $this->middleware('permission:offday-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:offday-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // dd($request->position_id);
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $ranks = Position::All();
        
          
        $offdays = new Offday();
        $offdays = $offdays->leftjoin('employee','employee.id','=','offday.emp_id')->leftjoin('users','users.id','=','offday.actionBy')->leftjoin('department','department.id','=','employee.dep_id')->leftjoin('branch','branch.id','=','employee.branch_id') ->select(
                                                    'offday.*',
                                                    'employee.name as empname',
                                                    'employee.photo',
                                                    'users.name',
                                                    'department.name As department_name',
                                                    'branch.name As branch_name',
                                                );
        if ($request->name != '') {
            $offdays = $offdays->where('employee.name','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $offdays = $offdays->where('employee.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $offdays = $offdays->where('employee.dep_id',$request->dept_id);
        }
        if ($request->position_id != '') {
            $offdays = $offdays->where('employee.position_id',$request->position_id);
        }

        if($request->date !=''){
            $offdays = $offdays->where('off_day_1',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_2',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_3',date('Y-m-d',strtotime($request->date)))
                                ->orwhere('off_day_4',date('Y-m-d',strtotime($request->date)));
        }

        $year = $request->year;
        if($year !=''){
            $offdays = $offdays->whereYear('offday.off_day_1',$year);
        }

        $month = $request->month;
        if($month !=''){
            $month = date('m',strtotime($month));
            $offdays = $offdays->whereMonth('offday.off_day_1',$month);
        }


        $count=$offdays->count();
        $emp_offdays = $offdays->get();
        $offdays = $offdays->orderBy('created_at','desc')->paginate(10);

        $emp_offday_arr = $emp_offdays->toArray();
        
        return view('admin.offday.index',compact('offdays','count','branches','departments','emp_offday_arr','ranks'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offday.create');
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
        $offday=Offday::create([
            'emp_id'=> $request->emp_id,
            'off_day_1'=>($request->off_day_1!='')?date('Y-m-d',strtotime($request->off_day_1)):NULL,
            'off_day_2'=>($request->off_day_2!='')?date('Y-m-d',strtotime($request->off_day_2)):NULL,
            'off_day_3'=>($request->off_day_3!='')?date('Y-m-d',strtotime($request->off_day_3)):NULL,
            'off_day_4'=>($request->off_day_4!='')?date('Y-m-d',strtotime($request->off_day_4)):NULL,
            'actionBy'=>auth()->user()->id,
        ]
        );
        return redirect()->route('offday.index')->with('success','Offday created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $emp_offdays = Offday::where('emp_id',$id)->get();
       $emp_offday_arr = [];
       foreach ($emp_offdays as $key => $value) {
        // dd($value->off_day_1);
           array_push($emp_offday_arr, $value->off_day_1);
           array_push($emp_offday_arr, $value->off_day_2);
           array_push($emp_offday_arr, $value->off_day_3);
           array_push($emp_offday_arr, $value->off_day_4);
       }

        return view('admin.offday.show',compact('emp_offdays','emp_offday_arr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offdays=Offday::find($id);
        $employees = Employee::all();
        return view('admin.offday.edit',compact('offdays','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $offdays=Offday::find($id);
        $offdays=$offdays->update([
            'emp_id'=> $request->emp_id,
            'off_day_1'=>($request->off_day_1!='')?date('Y-m-d',strtotime($request->off_day_1)):NULL,
            'off_day_2'=>($request->off_day_2!='')?date('Y-m-d',strtotime($request->off_day_2)):NULL,
            'off_day_3'=>($request->off_day_3!='')?date('Y-m-d',strtotime($request->off_day_3)):NULL,
            'off_day_4'=>($request->off_day_4!='')?date('Y-m-d',strtotime($request->off_day_4)):NULL,
            'actionBy'=>auth()->user()->id,
        ]
        );
        return redirect()->route('offday.index')->with('success','Offday updated successfully');;;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offday  $offday
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
        $offdays = Offday::find($id);
        $offdays->delete();
        return redirect()->route('offday.index')->with('success','Offday deleted successfully');;;
    }

     public function offdayimport(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new OffdayImport,request()->file('file'));
             
        return back();
    }

     public function downloadOffdaysCSV()
    {

        $strpath = public_path().'/uploads/files/offday.xlsx';
        // dd($strpath);
        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Offday Template.xlsx';

        return response()->download($csvFile, $fileName, $headers);

        
    }

      public function offdayexport(Request $request) 
    {

        $offday = new Offday();
      
        if($request->branch_id != ''){
            $offday = $offday->where('employee.branch_id',$request->branch_id);
        }

        if($request->dept_id != ''){
            $offday = $offday->where('employee.dep_id',$request->dept_id);
        }

        // dd($offday->get());

        $offday = $offday->leftjoin('employee','employee.id','=','offday.emp_id')
        ->select(
                
                'employee.photo As photo',
                'employee.name As name',
                DB::raw('DATE_FORMAT(offday.off_day_1, "%d-%b-%Y") as day_1'),
                DB::raw('DATE_FORMAT(offday.off_day_2, "%d-%b-%Y") as day_2'),
                DB::raw('DATE_FORMAT(offday.off_day_3, "%d-%b-%Y") as day_3'),
                DB::raw('DATE_FORMAT(offday.off_day_4, "%d-%b-%Y") as day_4'),
           )->get()->toArray();
        // dd($offday);

      
        // \Excel::store(
        //         new \App\Exports\EmployeeExport(array_keys($employees[0]),$employees, $employees),
        //         'employees'.'.xlsx',
        //         'local',
        //         \Maatwebsite\Excel\Excel::XLSX);
        return Excel::download(new OffdayExport(array_keys($offday[0]),$offday, $offday), 'offday.xlsx');
    }

}
