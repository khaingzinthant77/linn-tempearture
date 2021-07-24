<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use App\Imports\SalaryImport;
use App\Exports\SalaryExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Employee;
use App\Department;
use DB;
use File;

class SalaryController extends Controller
{
   public function __construct() 
    {
      $this->middleware('permission:salary-list|salary-create|salary-edit|salary-delete', ['only' => ['index','show']]);
      $this->middleware('permission:salary-create', ['only' => ['create','store']]);
      $this->middleware('permission:salary-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:salary-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $year = isset($request->year)?$request->year:date('Y');

        $departments = Department::all();

        $salarys = Salary::all();

        $employees = new Employee();
        if($request->name != '') {
        $employees = $employees->Where('name','like','%'.$request->name.'%');
        // dd($employees->get());
        }
         if ($request->dep_id != '') {
            $employees = $employees->where('dep_id',$request->dep_id);
        }

        if ($year != '') {
            $salarys = $salarys->where('year',$year);
            // dd($salarys);
           
        }

       
        $count = $employees->count();
        $employees = $employees->paginate(10);

        // dd(DB::table('salarys')->latest()->get()->first());
        return view('admin.salary.index',compact('employees','salarys','departments','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('admin.salary.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->pay_date);
      // $this->validate($request,[

      // ]);
        $employees = Employee::all();
        // dd($request->emp_id);
        // $salarys = Salary::all();
        
        $date = date('m',strtotime($request->pay_date));
        $month_total =  $request->salary_amt + $request->bonus;
        // dd(date('m',strtotime($request->pay_date)));
        if($date == '01'){
            $dates = "January";
        }elseif ($date == '02') {
            $dates = "February";
        }elseif ($date == '03') {
            $dates = "March";
        }elseif ($date == '04') {
            $dates = "April";
        }elseif ($date == '05') {
            $dates = "May";
        }elseif ($date == '06') {
            $dates = "June";
        }elseif ($date == '07') {
            $dates = "July";
        }elseif ($date == '08') {
            $dates = "August";
        }elseif ($date == '09') {
            $dates = "September";
        }elseif ($date == '10') {
            $dates = "October";
        }elseif ($date == '11') {
            $dates = "November";
        }elseif ($date == '12') {
            $dates = "December";
        }

        $salarys = Salary::where('emp_id',$request->emp_id)->where('pay_date',$dates)->where('year', date('Y',strtotime($request->pay_date)))->get();
        // dd($salarys); 

        $empid = $request->emp_id;

        foreach ($employees as $key => $value) {
            if ($value->id == $empid) {
                $empname = $value->name;
            }
        }
         if ($salarys->count()>0) {
            foreach ($salarys as $key => $salary) {
              $pay_date = $salarys[$key]->pay_date;
              $year = $salarys[$key]->year;
               if ($year == date('Y',strtotime($request->pay_date)) && $pay_date == $dates){
                  // dd("Here");
                return redirect()->route('salary.index')->with('success','Salary exist');
               }else{
                      $salary=Salary::create([
                      'emp_id'=>$empid,
                      'name'=>$empname,
                      'department'=>$request->department,
                      'branch'=>$request->branch,
                      'pay_date'=>$dates,
                      'year'=>date('Y',strtotime($request->pay_date)),
                      'salary_amt'=>$request->salary_amt,
                      'bonus'=>$request->bonus,
                      'month_total'=>$month_total,
                  ]
                  );
                      // dd("Not HEre");
                      return redirect()->route('salary.index')->with('success','Salary created successfully');
                         }
                      }
         }else{
             $salary=Salary::create([
            'emp_id'=>$empid,
            'name'=>$empname,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'pay_date'=>$dates,
            'year'=>date('Y',strtotime($request->pay_date)),
            'salary_amt'=>$request->salary_amt,
            'bonus'=>$request->bonus,
            'month_total'=>$month_total,
        ]
        );
            return redirect()->route('salary.index')->with('success','Salary created successfully');
           
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $year = isset($request->year)?$request->year:date('Y');

        $salarys =new Salary();
        if ($year != '') {
            $salarys = $salarys->where('year',$year);
        }
        
        if ($request->month != '') {
            $salarys = $salarys->where('pay_date',$request->month);
        }

        $salarys = $salarys->where('emp_id',$id);

        $employees = Employee::find($id);
        $count = $salarys->count();
        $salarys = $salarys->get();
       
        return view('admin.salary.show',compact('employees','salarys','count'))->with('i', (request()->input('page', 1) - 1) * 12);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salarys = Salary::find($id);
        return view('admin.salary.edit',compact('salarys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
         $salarys = Salary::find($id);
          $salarys = $salarys->update([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'pay_date'=>$request->pay_date,
            'year'=>$request->year,
            'salary_amt'=>$request->salary_amt,
            'bonus'=>$request->bonus,
            'month_total'=>$request->month_total,
        ]);
         return redirect()->route('salary.index')->with('success','Salary updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary = Salary::findorfail($id);
        $salary->delete();
        return redirect()->route('salary.index')
                        ->with('success','Salary deleted successfully');
    }

      public function import(Request $request) 
    {
        $request->validate([
            'file'=>'required',
        ]);

        Excel::import(new SalaryImport,request()->file('file'));
             
        return back();
    }

     public function downloadSalarysCSV()
    {

        $strpath = public_path().'/uploads/files/salarys.xlsx';
        // dd($strpath);
        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Salary Template.xlsx';

        return response()->download($csvFile, $fileName, $headers);

        
    }

    public function selectSearch(Request $request)
    {
        $data = new Employee();
        // $data = $data->leftjoin('inquiries','inquiries.id','=','customers.cust_id')
        //                ->select(
        //                 'customers.id',
        //                 'inquiries.name',
        //                 'inquiries.ph_no'
        //                );
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
       
        $data = $data->get();
        // dd($data);
        // $data =$data->select('name',DB::raw("CONCAT(nrc_code,'/',nrc_state,'(နိုင်)',nrc_no) as full_nrc"));
        return response()->json($data);
    }

    public function export() 
    {
      // dd("here");
        return Excel::download(new SalaryExport,'salary.xlsx');
    }

    public function salaryValidate($id,$salarys)
    {
        // if ($salarys[$id]->year == date('Y',strtotime($request->pay_date)) && $salarys[$i]->pay_date == $dates)
      $pay_date = $salarys[$id]->pay_date;
      return $pay_date;
    }

}
