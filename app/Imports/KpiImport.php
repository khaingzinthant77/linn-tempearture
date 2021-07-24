<?php

namespace App\Imports;

use App\Employee;
use App\KPI;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class KpiImport implements ToCollection,WithHeadingRow
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
                       $employees = Employee::all();
                        foreach ($employees as $key => $value) {
                            if($row['employee_id'] == $value->emp_id){
                               $employeeid = $value->id;
                                // dd( $value->id);
                            }
                        }


                        

                        $kpis = KPI::where('emp_id',$employeeid)->where('month',$row['month'])->where('year', $row['year'])->get();
                         $totalpoint = 0;
                         $totalpoint = $row['knowledge'] + $row['descipline'] + $row['skill_set'] + $row['teamwork'] + $row['social'] + $row['motivation']; 
                        // dd($kpis->count());

                        if($row['month'] == '01'){
                            $dates = "January";
                        }elseif ($row['month'] == '02') {
                            $dates = "February";
                        }elseif ($row['month'] == '03') {
                            $dates = "March";
                        }elseif ($row['month'] == '04') {
                            $dates = "April";
                        }elseif ($row['month'] == '05') {
                            $dates = "May";
                        }elseif ($row['month'] == '06') {
                            $dates = "June";
                        }elseif ($row['month'] == '07') {
                            $dates = "July";
                        }elseif ($row['month'] == '08') {
                            $dates = "August";
                        }elseif ($row['month'] == '09') {
                            $dates = "September";
                        }elseif ($row['month'] == '10') {
                            $dates = "October";
                        }elseif ($row['month'] == '11') {
                            $dates = "November";
                        }elseif ($row['month'] == '12') {
                            $dates = "December";
                        }

                        if ($kpis->count()>0) {
                             return redirect()->route('kpi.index')->with('success','KPI exist');
                        }else{

                              $arr=[
                                        'emp_id'=>$employeeid,
                                        'knowledge'=>$row['knowledge'],
                                        'descipline'=>$row['descipline'],
                                        'skill_set'=>$row['skill_set'],
                                        'team_work'=>$row['teamwork'],
                                        'social'=>$row['social'],
                                        'motivation'=>$row['motivation'],
                                        'total'=>$totalpoint,
                                        'month'=>$dates,
                                        'year'=>$row['year'],
                                        'comment'=>$row['comment']
                                        ];
                                       
                                KPI::create($arr);
                                return redirect()->route('kpi.index')->with('success','KPI excel import success');
                          
                        }
                }
            DB::commit();
        }

        catch (Exception $e) {
              DB::rollback();
                return redirect()->route('kpi.index')
                            ->with('error','Something wrong!');
         }
    }
}