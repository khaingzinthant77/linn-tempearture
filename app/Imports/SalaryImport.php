<?php

namespace App\Imports;

use App\Employee;
use App\Salary;
use App\Branch;
use App\Department;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class SalaryImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Employee([
    //         'emp_id'     => $row[1],
    //         'emp_name'    => $row[2], 
    //         'branch' => $row[3],
    //         'dept' => $row[4]
    //     ]);
    // }
    public function collection(Collection $rows)
    {
      
        DB::beginTransaction();
        try {

            
                foreach ($rows as $row) 
                {
                    // dd($row);
                        $month_total = $row['basic_pay']+$row['performance_allowance']+$row['bonus']; 

                        $amount = $row['basic_pay']+$row['performance_allowance'];

                        $employees = Employee::all();
                        $branchs = Branch::all();
                        $departments = Department::all();

                        foreach ($employees as $key => $value) {
                            if($row['id'] == $value->emp_id){
                                $employee_name= $value->name;
                                $employeeid = $value->id;
                                // dd( $employee_name);
                            }
                        }

                      
                        $search_employee = $employees->find($employeeid);
                        // dd($search_employee);
                        $branchid = $search_employee->branch_id;
                        $departmentid = $search_employee->dep_id;
                        // dd($branchid);

                        foreach ($branchs as $key => $value) {
                            if ($value->id == $branchid) {
                               $branchname=$value->name;
                               // dd($branchname);
                            }
                        }

                        foreach ($departments as $key => $value) {
                            if ($value->id == $departmentid) {
                                $departmentname = $value->name;
                            }
                        }

                        if($row['month'] == '1'){
                            $dates = "January";
                        }elseif ($row['month'] == '2') {
                            $dates = "February";
                        }elseif ($row['month'] == '3') {
                            $dates = "March";
                        }elseif ($row['month'] == '4') {
                            $dates = "April";
                        }elseif ($row['month'] == '5') {
                            $dates = "May";
                        }elseif ($row['month'] == '6') {
                            $dates = "June";
                        }elseif ($row['month'] == '7') {
                            $dates = "July";
                        }elseif ($row['month'] == '8') {
                            $dates = "August";
                        }elseif ($row['month'] == '9') {
                            $dates = "September";
                        }elseif ($row['month'] == '10') {
                            $dates = "October";
                        }elseif ($row['month'] == '11') {
                            $dates = "November";
                        }elseif ($row['month'] == '12') {
                            $dates = "December";
                        }

                        $salarys = Salary::where('emp_id',$employeeid)->where('pay_date',$dates)->where('year', $row['year'])->get();
                        // dd($employeeid);


                        if ($salarys->count()>0) {
                            foreach ($salarys as $key => $salary) {
                              $pay_date = $salarys[$key]->pay_date;
                              $year = $salarys[$key]->year;
                               if ($year == $row['year'] && $pay_date == $dates){
                                  // dd("Here");
                                return redirect()->route('salary.index')->with('success','Salary exist');
                               }else{
                                     
                                      // dd("Not HEre");
                                      $arr=[
                                        'emp_id'=>$employeeid,
                                        'name'=>$employee_name,
                                        'department'=>$departmentname,
                                        'branch'=>$branchname,
                                        'pay_date'=>$dates,
                                        'year'=>$row['year'],
                                        'salary_amt'=>$amount,
                                        'bonus'=>$row['bonus'],
                                        'month_total'=>$month_total,
                                        ];
                                       
                                        Salary::create($arr);
                                         }
                                      }
                         }else{
                            
                             $arr=[
                                        'emp_id'=>$employeeid,
                                        'name'=>$employee_name,
                                        'department'=>$departmentname,
                                        'branch'=>$branchname,
                                        'pay_date'=>$dates,
                                        'year'=>$row['year'],
                                        'salary_amt'=>$amount,
                                        'bonus'=>$row['bonus'],
                                        'month_total'=>$month_total,
                                        ];
                                       
                             Salary::create($arr);
                           
                         }
                    
                        //  $arr=[
                        // 'emp_id'=>$employeeid,
                        // 'name'=>$employee_name,
                        // 'department'=>$departmentname,
                        // 'branch'=>$branchname,
                        // 'pay_date'=>$dates,
                        // 'year'=>$row['year'],
                        // 'salary_amt'=>$row['amount'],
                        // 'bonus'=>$row['bonus'],
                        // 'month_total'=>$month_total,
                        // ];
                       
                        // Salary::create($arr);

                }
            DB::commit();
        }

        catch (Exception $e) {
              DB::rollback();
                return redirect()->route('salary.index')
                            ->with('error','Something wrong!');
         }
    }
}