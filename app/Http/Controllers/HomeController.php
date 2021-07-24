<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Branch;
use Carbon\Carbon;
use DB;
use App\LeaveApplication;
use App\Offday;
use App\Overtime;
use App\Attendance;
use App\KPI;
use App\NoticeBoard;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_employees = Employee::where('active',1)->count();
        $total_branches = Branch::count();
        $total_departments = Department::count();

        // $new_empoyee = Employee::WhereRaw('(DATEDIFF(employee.join_date, NOW())>10)')->get();

        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth(); 
        $new_empoyee = Employee::whereBetween('join_date',[$dateS,$dateE])->get()->count();

        //get employee count by dept
        $dept_employees = Department::with('employees')->get();

        $deptArr =[];
        $deptEmpArr =[];

        $malecount = 0;
        $femalecount = 0;
        $deptMaleArr = [];
        $deptFemaleArr = [];


        foreach ($dept_employees as $key => $dep) {
            array_push($deptArr, $dep->name);
            array_push($deptEmpArr, $dep->employees()->count());
        }

        $maleTotal = Employee::where('gender','Male')->where('active',1)->count();
        $femaleTotal = Employee::where('gender','Female')->where('active',1)->count();



        $deptMaleArr = DB::table('department')
                             ->select('department.name', DB::raw('count(employee.id) as mtotal'))
                             ->leftjoin('employee','employee.dep_id','department.id')
                             ->where('employee.gender','Male')
                             ->groupBy('dep_id')
                             ->get();

        $deptfeMaleArr = DB::table('department')
                             ->select('department.name', DB::raw('count(employee.id) as fmtotal'))
                             ->leftjoin('employee','employee.dep_id','department.id')
                             ->where('employee.gender','Female')
                             ->groupBy('dep_id')
                             ->get();


        $branchArr =[];
        $branchEmpArr =[];

        $branchs = Branch::with('employees')->get();

        foreach ($branchs as $key => $branch) {
            array_push($branchArr, $branch->name);
            array_push($branchEmpArr, $branch->employees()->count());
        }


        // $hostelNotStay = Employee::whereNull('hostel')->count();
        // $hostelStay = Employee::whereNotNull('hostel')->count();

        $hostelNotStay = Employee::where('hostel','No')->where('active',1)->count();
        $hostelStay = Employee::where('hostel','!=','No')->where('active',1)->count();


        $date = now();
        $bd_employess = Employee::select('name','date_of_birth')->whereMonth('date_of_birth', '=', $date->month)
                             ->whereDay('date_of_birth', '>=', $date->day)
                            ->orWhere(function ($query) use ($date) {
                               $query->whereMonth('date_of_birth', '=', $date->month)
                                   ->whereDay('date_of_birth', '>=', $date->day);

                           })
           // ->orderByRaw("DAYOFMONTH('date_of_birth')",'desc')
           ->orderByRaw('DATE_FORMAT(date_of_birth, "%m-%d")')->where('active',1)
           ->get()->toArray();


        

        $branchHostelArr = DB::table('branch')
                             ->selectRaw('branch.name')
                             ->selectRaw("count(case when gender = 'Male' then 1 end) as hmcont")
                             ->selectRaw("count(case when gender = 'Female' then 1 end) as hfmcont")
                             // ->leftjoin('hostel_employee','hostel.id','hostel_employee.hostel_id')
                             ->leftjoin('employee','employee.branch_id','branch.id')
                             ->groupBy('branch.name')
                             ->where('employee.hostel','Yes')
                             ->get()->toArray();


        $hostelArr = DB::table('hostel')
                             ->selectRaw('hostel.name')
                             ->selectRaw("count(case when gender = 'Male' then 1 end) as mcont")
                             ->selectRaw("count(case when gender = 'Female' then 1 end) as fmcont")
                             ->leftjoin('hostel_employee','hostel.id','hostel_employee.hostel_id')
                             ->leftjoin('employee','employee.id','hostel_employee.emp_id')
                             ->groupBy('hostel.name')
                             ->get()->toArray();

        $notice_boards =  NoticeBoard::where('status',1)->orderBy('publish_date','desc')->paginate(5);
        // return view('frontend.news',compact('news'));
       
        return view('dashboard',compact('total_employees','total_departments','total_branches','new_empoyee','deptArr','deptEmpArr','maleTotal','femaleTotal','branchArr','branchEmpArr','hostelStay','hostelNotStay','bd_employess','hostelArr','branchHostelArr','notice_boards'));
    }


    public function hrDashboard()
    {

        $attendance_count = Attendance::where('date',date('Y-m-d'))->get()->count();

        $leave_count = LeaveApplication::whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->get()->count();
        

        $offday_count = OffDay::where('off_day_1',date('Y-m-d'))->orwhere('off_day_2',date('Y-m-d'))->orwhere('off_day_3',date('Y-m-d'))->orwhere('off_day_4',date('Y-m-d'))->get()->count();
        
        $overtime_count = Overtime::where('apply_date',date('Y-m-d'))->get()->count();
        $emp_count = Employee::where('active',1)->get()->count();

        
        $attbrArr = DB::table('branch')
                             ->selectRaw('branch.name')
                             ->selectRaw("count(attendances.id) as attcount")
                             ->leftjoin('employee','branch.id','employee.branch_id')
                             ->leftjoin('attendances','employee.id','attendances.emp_id')
                             ->where('date',date('Y-m-d'))
                             ->groupBy('branch.id')
                             ->get()->toArray();

        $branchArr = [];
        $branchAttCountArr = [];

        foreach ($attbrArr as $key => $attb) {
            array_push($branchArr, $attb->name);
            array_push($branchAttCountArr, $attb->attcount);
        }


        $attDetpArr = DB::table('department')
                             ->selectRaw('department.name')
                             ->selectRaw("count(attendances.id) as attcount")
                             ->leftjoin('employee','department.id','employee.dep_id')
                             ->leftjoin('attendances','employee.id','attendances.emp_id')
                             ->where('date',date('Y-m-d'))
                             ->groupBy('department.id')
                             ->get()->toArray();

        $deptArr = [];
        $deptAttCountArr = [];

        foreach ($attDetpArr as $key => $attdept) {
            array_push($deptArr, $attdept->name);
            array_push($deptAttCountArr, $attdept->attcount);
        }


        $date = now();
        $bd_employess = Employee::select('name','date_of_birth')->whereMonth('date_of_birth', '=', $date->month)
                             ->whereDay('date_of_birth', '>=', $date->day)
                            ->orWhere(function ($query) use ($date) {
                               $query->whereMonth('date_of_birth', '=', $date->month)
                                   ->whereDay('date_of_birth', '>=', $date->day);

                           })
                           ->orderByRaw('DATE_FORMAT(date_of_birth, "%m-%d")')
                           ->where('active',1)->get()->toArray();


        $offday_employess = OffDay::select('employee.name as empname','branch.name as branch_name','department.name as dep_name','employee.photo')
                                    ->leftjoin('employee','employee.id','offday.emp_id')
                                    ->leftjoin('branch','branch.id','employee.branch_id')
                                    ->leftjoin('department','department.id','employee.dep_id')
                                    ->where('off_day_1',date('Y-m-d'))
                                    ->orwhere('off_day_2',date('Y-m-d'))
                                    ->orwhere('off_day_3',date('Y-m-d'))
                                    ->orwhere('off_day_4',date('Y-m-d'))
                                    ->paginate(10);


        $total_branches = Branch::count();
        $total_departments = Department::count();

        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth(); 
        $new_empoyee = Employee::whereBetween('join_date',[$dateS,$dateE])->get()->count();

        $leaveChart = DB::table('leave_applications')
                             ->selectRaw('department.name')
                             ->selectRaw("count(leave_applications.id) as count")
                             ->leftjoin('employee','employee.id','leave_applications.emp_id')
                             ->leftjoin('department','department.id','employee.dep_id')
                             ->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))
                             ->groupBy('department.id')
                             ->get()->toArray();

        $leavDeptArr = [];
        $leavDeptCountArr = [];

        foreach ($leaveChart as $key => $leave) {
            array_push($leavDeptArr, $leave->name);
            array_push($leavDeptCountArr, $leave->count);
        }

        $offday_count = OffDay::where('off_day_1',date('Y-m-d'))->orwhere('off_day_2',date('Y-m-d'))->orwhere('off_day_3',date('Y-m-d'))->orwhere('off_day_4',date('Y-m-d'))->get()->count();


        $offday_arr = DB::table('offday')
                                    ->selectRaw('department.name')
                                    ->selectRaw("count(offday.id) as count")
                                    ->leftjoin('employee','employee.id','offday.emp_id')
                                    ->leftjoin('branch','branch.id','employee.branch_id')
                                    ->leftjoin('department','department.id','employee.dep_id')
                                    ->where('off_day_1',date('Y-m-d'))
                                    ->orwhere('off_day_2',date('Y-m-d'))
                                    ->orwhere('off_day_3',date('Y-m-d'))
                                    ->orwhere('off_day_4',date('Y-m-d'))
                                    ->groupBy('department.id')
                                     ->get()->toArray();

        $offDeptArr = [];
        $offDeptCountArr = [];

        foreach ($offday_arr as $key => $offday) {
            array_push($offDeptArr, $offday->name);
            array_push($offDeptCountArr, $offday->count);
        }

       
        return view('admin.dashboard.hr_dashboard',compact('attendance_count','leave_count','offday_count','overtime_count','emp_count','deptArr','branchArr','branchAttCountArr','deptArr','deptAttCountArr','bd_employess','offday_employess','total_branches','total_departments','new_empoyee','leavDeptArr','leavDeptCountArr','offDeptArr','offDeptCountArr'));
    }


    public function kpiDashboard(Request $request)
    {   

       
        $month = ($request->month!='')?$request->month:date('F');
        $year = ($request->year!='')?$request->year:date('Y');

        $branchKPIArr = DB::table('branch')
                             ->selectRaw('branch.name as bname')
                             ->selectRaw("count(kpi.id) as count")
                             ->selectRaw("sum(kpi.knowledge) as knowledge")
                             ->selectRaw("sum(kpi.descipline) as descipline")
                             ->selectRaw("sum(kpi.skill_set) as skill_set")
                             ->selectRaw("sum(kpi.team_work) as team_work")
                             ->selectRaw("sum(kpi.social) as social")
                             ->selectRaw("sum(kpi.motivation) as motivation")
                             ->leftjoin('employee','branch.id','employee.branch_id')
                             ->leftjoin('kpi','employee.id','kpi.emp_id')
                             ->groupBy('branch.id')
                             ->where('kpi.month',date('m',strtotime($month)))
                             ->where('kpi.year',$year)
                             ->get()->toArray();




        $branchArr = [];
        $bkpiArr = [];

        foreach ($branchKPIArr as $key => $data) {
            $totalpoint = $data->knowledge + $data->descipline + $data->skill_set + $data->team_work + $data->social + $data->motivation;
            $avgpt = $totalpoint / $data->count;
            $avgtotalpoint =  number_format((float)$avgpt, 2, '.', '');
            array_push($branchArr, $data->bname);
            array_push($bkpiArr, $avgtotalpoint);  
        }





        $deptsKPIArr = DB::table('department')
                             ->selectRaw('department.name as depname')
                             ->selectRaw("count(kpi.id) as count")
                             ->selectRaw("sum(kpi.knowledge) as knowledge")
                             ->selectRaw("sum(kpi.descipline) as descipline")
                             ->selectRaw("sum(kpi.skill_set) as skill_set")
                             ->selectRaw("sum(kpi.team_work) as team_work")
                             ->selectRaw("sum(kpi.social) as social")
                             ->selectRaw("sum(kpi.motivation) as motivation")
                             ->leftjoin('employee','department.id','employee.dep_id')
                             ->leftjoin('kpi','employee.id','kpi.emp_id')
                             ->groupBy('department.id')
                             ->where('kpi.month',date('m',strtotime($month)))
                             ->where('kpi.year',$year)
                             ->orderBy('department.name','asc')
                             ->get()->toArray();



        $deptArr = [];
        $kpiArr = [];

        foreach ($deptsKPIArr as $key => $data) {
            $totalpoint = $data->knowledge + $data->descipline + $data->skill_set + $data->team_work + $data->social + $data->motivation;
            $avgpt = $totalpoint / $data->count;
            array_push($deptArr, $data->depname);
            array_push($kpiArr, $avgpt);
        }


         $aso = KPI::with('employee')->where('kpi.year','2020')->where('emp_id',592)->orderBy('month','asc')->get()->toArray();


         $monthArr =[];
         $asoPoint = [];
         foreach ($aso as $key => $val) {
            $point = $val['knowledge'] + $val['descipline'] + $val['skill_set'] + $val['team_work'] + $val['social'] + $val['motivation'];

            $month = $val['month'];

            if( $month== '01'){
                 $month = "Jan";
            }elseif ( $month== '02') {
                 $month = "Feb";
            }elseif ( $month== '03') {
                 $month = "Mar";
            }elseif ( $month== '04') {
                 $month = "Apr";
            }elseif ( $month== '05') {
                 $month = "May";
            }elseif ( $month== '06') {
                 $month = "June";
            }elseif ( $month== '07') {
                 $month = "July";
            }elseif ( $month== '08') {
                 $month = "Aug";
            }elseif ( $month== '09') {
                 $month = "Sept";
            }elseif ( $month== '10') {
                 $month = "Oct";
            }elseif ( $month== '11') {
                 $month = "Nov";
            }elseif ( $month== '12') {
                 $month = "Dec";
            }
            array_push($monthArr,$month);
            array_push($asoPoint, $point);
         }

        $min = 20;
        $max = 30;
        $bestEmployees = DB::table('employee')
                             ->selectRaw('employee.name as empname')
                             ->selectRaw('employee.emp_id as empID')
                             ->selectRaw('employee.photo as photo')
                             ->selectRaw('branch.name as branch')
                             ->selectRaw('department.name as department')
                             ->selectRaw("kpi.id as kpiid")
                             ->selectRaw("max(kpi.total) as total")
                             ->leftjoin('kpi','employee.id','kpi.emp_id')
                             ->leftjoin('branch','branch.id','employee.branch_id')
                             ->leftjoin('department','department.id','employee.dep_id')
                             ->where('kpi.month',($request->month!='')?date('m',strtotime($request->month)):date('m'))
                             ->where('kpi.year',$year)
                             ->groupBy('kpi.emp_id','kpi.id')
                             ->orderBy('total','desc')
                             ->whereBetween('total', [$min, $max])
                             ->get();


        // $kpis = KPI::all();

        // foreach ($kpis as $key => $kpi) {
        //     $row = KPI::find($kpi->id);
        //     $res = $row->update([
        //         'total' => $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation
        //     ]);
        // }


        return view('admin.dashboard.kpi_dashboard',compact('deptArr','kpiArr','monthArr','asoPoint','branchArr','bkpiArr','bestEmployees'));
    }

    public function orgChart(){
        return view('admin.setting.organization');
    }
}
