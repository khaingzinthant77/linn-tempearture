<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use DB;
use Validator;
use App\Employee;
use App\LeaveApplication;
use App\Offday;
use App\Overtime;

class TimeInApiController extends Controller
{

    public function attendance_dashboard(Request $request)
    {
        $input = $request->all();
             $rules=[
                'attendance_date'=>'required'
            ];

            $validator = Validator::make($input, $rules);

             if ($validator->fails()) {
                $messages = $validator->messages();
                   return response()->json(['message'=>"Error",'status'=>0]);
            }else{
                $attendance_count = Attendance::where('date',date('Y-m-d',strtotime($request->attendance_date)))->get()->count();

                $leave_count = LeaveApplication::whereDate('start_date','<=',date('Y-m-d',strtotime($request->attendance_date)))->whereDate('end_date','>=',date('Y-m-d',strtotime($request->attendance_date)))->get()->count();
                

                $offday_count = OffDay::where('off_day_1',date('Y-m-d',strtotime($request->attendance_date)))->orwhere('off_day_2',date('Y-m-d',strtotime($request->attendance_date)))->orwhere('off_day_3',date('Y-m-d',strtotime($request->attendance_date)))->orwhere('off_day_4',date('Y-m-d',strtotime($request->attendance_date)))->get()->count();
                
                $overtime_count = Overtime::where('apply_date',date('Y-m-d',strtotime($request->attendance_date)))->get()->count();
                $emp_count = Employee::where('active',1)->get()->count();

                return response(['message'=>"Success",'status'=>1,'attendance_count'=>$attendance_count,'leave_count'=>$leave_count,'offday_count'=>$offday_count,'overtime_count'=>$overtime_count,'total'=>$emp_count]);
            }
    }
    public function attendance_list(Request $request)
    {
        $input = $request->all();
             $rules=[
                'page'=>'required'
            ];

            $validator = Validator::make($input, $rules);

             if ($validator->fails()) {
                $messages = $validator->messages();
                   return response()->json(['message'=>"Error",'status'=>0]);
            }else{
                if ($request->page != 0) {
                    $attendances = new Attendance();
                    $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                    ->leftjoin('branch','branch.id','=','employee.branch_id')
                                    ->leftjoin('department','department.id','=','employee.dep_id')
                                    ->leftjoin('position','position.id','=','employee.position_id')
                                    ->select(
                                        'attendances.*',
                                        'employee.name',
                                        'employee.photo',
                                        'branch.name AS branch_name',
                                        'department.name AS dept_name',
                                        'position.name AS position_name'
                                    );
                    if ($request->date != '') {
                        $date = date('Y-m-d', strtotime($request->date));
                        $attendances = $attendances->whereDate('attendances.date',$date);
                    }
                    if ($request->keyword != '') {
                        $attendances = $attendances->where('employee.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->branch_id != '') {
                        $attendances = $attendances->where('employee.branch_id',$request->branch_id);
                    }
                    if ($request->dept_id != '') {
                        $attendances = $attendances->where('employee.dep_id',$request->dept_id);
                    }
                    if ($request->emp_id != null) {
                        $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                        $attendances = $attendances->orderBy('attendances.id','desc')->limit(10)->paginate(10);
                        
                    }else{
                        $attendances = $attendances->orderBy('attendances.id','desc')->limit(10)->paginate(10);
                    }
                    
                    return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
                }else{
                    $attendances = new Attendance();
                    $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                    ->leftjoin('branch','branch.id','=','employee.branch_id')
                                    ->leftjoin('department','department.id','=','employee.dep_id')
                                    ->leftjoin('position','position.id','=','employee.position_id')
                                    ->select(
                                        'attendances.*',
                                        'employee.name',
                                        'employee.photo',
                                        'branch.name AS branch_name',
                                        'department.name AS dept_name',
                                        'position.name AS position_name'
                                    );
                    if ($request->date != '') {
                        $date = date('Y-m-d', strtotime($request->date));
                        $attendances = $attendances->whereDate('attendances.date',$date)->orwhereDate('attendances.out_date',$date);
                    }
                    if ($request->keyword != '') {
                        $attendances = $attendances->where('employee.name','like','%'.$request->keyword.'%');
                    }
                    if ($request->branch_id != '') {
                        $attendances = $attendances->where('employee.branch_id',$request->branch_id);
                    }
                    if ($request->dept_id != '') {
                        $attendances = $attendances->where('employee.dep_id',$request->dept_id);
                    }
                    if ($request->emp_id != null) {
                        $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                        $attendances = $attendances->orderBy('attendances.id','desc')->get();
                        
                    }else{
                        $attendances = $attendances->orderBy('attendances.id','desc')->get();
                    }
                    
                    return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);
                }
            }
    }

    public function time_in(Request $request)
    {
        $input = $request->all();
        $rules=[
            'clock_in'=>'required',
            'date'=>'required',
            'attendance_status'=>'required',
            'emp_id'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $attendance = Attendance::create([
                'clock_in'=>$request->clock_in,
                'date'=>date('Y-m-d',strtotime($request->date)),
                'attendance_status'=>$request->attendance_status,
                'emp_id'=>$request->emp_id,
                
            ]);
            return response(['message'=>"Successfully create",'status'=>1]);
        }
    }

    public function check_in_out(Request $request)
    {
        $input = $request->all();
        $rules=[
            'emp_id'=>'required',
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Emp_id is null",'status'=>0]);
        }else{
            $attendance = DB::table('attendances')->where('emp_id',$request->emp_id)->latest()->first();
            // dd($attendance->id);
            if ($attendance != null) {
                if ($attendance->clock_out != null) {
                return response(['message'=>"Success",'status'=>1,'attendance_id'=>$attendance->id,'timein_status'=>0,'timein_date'=>$attendance->date,'time_in'=>$attendance->clock_in]);
            }else{
                return response(['message'=>"Success",'status'=>1,'attendance_id'=>$attendance->id,'timein_status'=>1,'timein_date'=>$attendance->date,'time_in'=>$attendance->clock_in]);
            }
            }else{
                return response(['message'=>"Success",'status'=>1,'timein_status'=>0]);
            }

        }
        
    }

    public function time_out(Request $request)
    {
        $input = $request->all();
        $rules=[
            'attendance_id'=>'required',
            'out_date'=>'required',
            'clock_out'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            $attendance = Attendance::find($request->attendance_id);
            $attendance = $attendance->update([
                'clock_out'=>$request->clock_out,
                'out_date'=>date('Y-m-d',strtotime($request->out_date))
            ]);
            return response(['message'=>"Success",'status'=>1]);
        }
    }


    public function emp_attendance_list(Request $request)
    {
        $input = $request->all();
        $rules=[
            'emp_id'=>'required',
            'page'=>'required',
            'month'=>'required',
            'year'=>'required'
        ];

        $validator = Validator::make($input, $rules);

         if ($validator->fails()) {
            $messages = $validator->messages();
               return response()->json(['message'=>"Error",'status'=>0]);
        }else{
            if ($request->page != 0) {
                $attendances = new Attendance();

                $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                            ->select(
                                                'attendances.*',
                                                'employee.name'
                                            );
                $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                // dd($attendances->get()->count());
                if ($attendances->get()->count()) {

                    $attendances = $attendances->whereYear('date', '=', $request->year)
                                  ->whereMonth('date', '=', $request->month);

                    $attendances = $attendances->limit(10)->paginate(10);

                    if (count($attendances)>0) {

                        return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);

                    }else{
                        return response(['message'=>"No Attendance",'status'=>1,'attendances'=>null]);
                    }
                }else{
                   return response(['message'=>"No Attendance",'status'=>1]); 
                }
            }else{
                $attendances = new Attendance();

                $attendances = $attendances->leftjoin('employee','employee.id','=','attendances.emp_id')
                                            ->select(
                                                'attendances.*',
                                                'employee.name'
                                            );
                $attendances = $attendances->where('attendances.emp_id',$request->emp_id);
                // dd($attendances->get()->count());
                if ($attendances->get()->count()) {

                    $attendances = $attendances->whereYear('date', '=', $request->year)
                                  ->whereMonth('date', '=', $request->month);

                    $attendances = $attendances->get();

                    if (count($attendances)>0) {

                        return response(['message'=>"Success",'status'=>1,'attendances'=>$attendances]);

                    }else{
                        return response(['message'=>"No Attendance",'status'=>1,'attendances'=>null]);
                    }
                }else{
                   return response(['message'=>"No Attendance",'status'=>1]); 
                }
            }
        }
    }


}
	