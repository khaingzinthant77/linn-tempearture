<?php

namespace App\Http\Controllers;

use App\Temperature;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Hostel;
use App\Branch;

class TemperatureController extends Controller
{
     public function index(Request $request)
    {
        $departments = Department::all();

        $temperatures = Temperature::all();
        $hostels = Hostel::all();
        $branchs = Branch::all();
        $employees = new Employee();
        $employees = $employees->where('hostel','Yes');
        // $employees = $employees->leftjoin('temperature','employee.id','=','temperature.emp_id');

        if ($request->hostel_id != '') {
            $employees = $employees->where('home_no',$request->hostel_id);
        }
        if ($request->branch_id != '') {
            $employees = $employees->where('branch_id',$request->branch_id);
        }

        // if ($request->month != '') {
        //     $employees = $employees->where('month',$request->month);
        // }
        // if ($request->year != '') {
        //     $employees = $employees->where('year',$request->year);
        // }
        $count = $employees->count();
        $employees = $employees->paginate(10);
        return view('admin.temperature.index',compact('employees','temperatures','departments','hostels','count','branchs'));
    }



    public function create(){
    	return view('admin.temperature.create');
    }

    public function store(Request $request)
    {
      // dd($request->temperture_no);

      // $this->validate($request,[

      // ]);
        $employees = Employee::all();
        // dd($request->emp_id);
        // $salarys = Salary::all();
        $day = date('d',strtotime($request->date));
        $month = date('m',strtotime($request->date));
        
        if($month == '01'){
            $dates = "January";
        }elseif ($month == '02') {
            $dates = "February";
        }elseif ($month == '03') {
            $dates = "March";
        }elseif ($month == '04') {
            $dates = "April";
        }elseif ($month == '05') {
            $dates = "May";
        }elseif ($month == '06') {
            $dates = "June";
        }elseif ($month == '07') {
            $dates = "July";
        }elseif ($month == '08') {
            $dates = "August";
        }elseif ($month == '09') {
            $dates = "September";
        }elseif ($month == '10') {
            $dates = "October";
        }elseif ($month == '11') {
            $dates = "November";
        }elseif ($month == '12') {
            $dates = "December";
        }

        $temperatures = Temperature::where('emp_id',$request->emp_id)->where('day',$day)->where('month',$dates)->where('year', date('Y',strtotime($request->date)))->get();
        // dd($salarys); 

        $empid = $request->emp_id;

        foreach ($employees as $key => $value) {
            if ($value->id == $empid) {
                $empname = $value->name;
            }
        }
         if ($temperatures->count()>0) {
           
            foreach ($temperatures as $key => $temperature) {
              $day = $temperatures[$key]->day;
              $month = $temperatures[$key]->month;
              $year = $temperatures[$key]->year;
               if ($day == date('d',strtotime($request->date)) && $month == $dates && $year == date('Y',strtotime($request->date))){
                  // dd("Here");
                return redirect()->route('temperature.index')->with('success','Temperature exist');
               }else{
                      $temperatures=Temperature::create([
                     'emp_id'=>$empid,
                        'name'=>$empname,
                        'department'=>$request->department,
                        'branch'=>$request->branch,
                        'day'=>$day,
                        'month'=>$dates,
                        'year'=>date('Y',strtotime($request->date)),
                        'temp_date'=>date('Y-m-d',strtotime($request->date)),
                        'temperture_no'=>$request->temperture_no,
                        'remark'=>$request->remark,
                  ]
                  );
                      // dd("Not HEre");
                      return redirect()->route('temperature.index')->with('success','Temperature created successfully');
                         }
                      }
         }else{
             $temperatures=Temperature::create([
            'emp_id'=>$empid,
            'name'=>$empname,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'day'=>$day,
            'month'=>$dates,
            'year'=>date('Y',strtotime($request->date)),
            'temp_date'=>date('Y-m-d',strtotime($request->date)),
            'temperture_no'=>$request->temperture_no,
            'remark'=>$request->remark,
        ]
        );
            return redirect()->route('temperature.index')->with('success','Temperature created successfully');
           
         }
    }


     public function show(Request $request,$id)
    {
        $year = isset($request->year)?$request->year:date('Y');

        $temperatures =new Temperature();
       
        $temperatures = $temperatures->where('emp_id',$id);

        $employees = Employee::find($id);
        $count = $temperatures->count();
        $temperatures = $temperatures->get();
       
        return view('admin.temperature.show',compact('employees','temperatures','count'))->with('i', (request()->input('page', 1) - 1) * 12);;
    }

    public function edit($id)
    {
        $temperatures = Temperature::find($id);
        return view('admin.temperature.edit',compact('temperatures'));
    }

     public function update(Request $request, $id)
    {
        // dd($request->all());
         $temperatures = Temperature::find($id);
          $temperatures = $temperatures->update([
            'emp_id'=>$request->emp_id,
            'name'=>$request->name,
            'department'=>$request->department,
            'branch'=>$request->branch,
            'day'=>$request->day,
            'month'=>$request->month,
            'year'=>$request->year,
            'temp_date'=>date('Y-m-d',strtotime($request->date)),
            'temperture_no'=>$request->temperture_no,
        ]);
         return redirect()->route('temperature.index')->with('success','Temperature updated successfully');
    }

     public function destroy($id)
    {
        $temperatures = Temperature::findorfail($id);
        $temperatures->delete();
        return redirect()->route('temperature.index')
                        ->with('success','Temperature deleted successfully');
    }


    public function selectSearch(Request $request)
    {
        $data = new Employee();
        $data = $data->where('hostel','Yes');
        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('name','like','%'.$search.'%');
        }
        $data = $data->get();
        return response()->json($data);
    }

    public function ajaxupdate(Request $request)
    {
        if ($request->ajax()) {
            if($request->pk!=null){
                $temperatures = Temperature::find($request->pk);
                $employee = new Employee();
      
                $employee = $employee->leftjoin('department','department.id','=','employee.dep_id')
                                  ->leftjoin('branch','branch.id','=','employee.branch_id')
                             ->select(
                              'department.name',
                              'branch.name AS branch_name',
                              'employee.name AS employee_name'
                             );
                $employee = $employee->find($temperatures->emp_id);
                
                $res = $temperatures->update([
                    'emp_id'=>$temperatures->emp_id,
                    'name'=>$temperatures->name,
                    'department'=>$temperatures->department,
                    'branch'=>$temperatures->branch,
                    'day'=>$temperatures->day,
                    'month'=>$temperatures->month,
                    'year'=>$temperatures->year,
                    'temp_date'=>date('Y-m-d',strtotime($temperatures->date)),
                    'temperture_no'=>$request->value,
                ]);

                if($res){
                    return response()->json(['success' => true]);
                }
            }else{
           
                $day = date('d',strtotime($request->date));
                $month = date('m',strtotime($request->date));
                
                if($month == '01'){
                    $dates = "January";
                }elseif ($month == '02') {
                    $dates = "February";
                }elseif ($month == '03') {
                    $dates = "March";
                }elseif ($month == '04') {
                    $dates = "April";
                }elseif ($month == '05') {
                    $dates = "May";
                }elseif ($month == '06') {
                    $dates = "June";
                }elseif ($month == '07') {
                    $dates = "July";
                }elseif ($month == '08') {
                    $dates = "August";
                }elseif ($month == '09') {
                    $dates = "September";
                }elseif ($month == '10') {
                    $dates = "October";
                }elseif ($month == '11') {
                    $dates = "November";
                }elseif ($month == '12') {
                    $dates = "December";
                }
                $employee = Employee::with(['viewBranch','viewDepartment'])->findorfail($request->empid);

                $res=Temperature::create(
                    [
                        'emp_id'=>$request->empid,
                        'name'=>$employee->name,
                        'department'=>$employee->viewDepartment->name,
                        'branch'=>$employee->viewBranch->name,
                        'day'=>$day,
                        'month'=>$dates,
                        'year'=>date('Y',strtotime($request->date)),
                        'temp_date'=>date('Y-m-d',strtotime($request->date)),
                        'temperture_no'=>$request->value,
                        'remark'=>$request->remark,
    
                    ]
                );

                if($res){
                    return response()->json(['success' => true]);
                }
            }
            
        }
    }

}
