<?php

namespace App\Imports;

use App\Offday;
use App\Employee;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use Carbon;
class OffdayImport implements ToCollection,WithHeadingRow
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
                            if ($row['employee_id'] == $value->emp_id) {
                               $employeeid = $value->id;
                            }
                        }
                    $off_day_one =$row['off_day_one'] ? $this->transformDate($row['off_day_one'])->format("Y-m-d") : null;
                    $off_day_two = $row['off_day_two'] ? $this->transformDate($row['off_day_two'])->format("Y-m-d") : null;
                    $off_day_three = $row['off_day_three'] ? $this->transformDate($row['off_day_three'])->format("Y-m-d") : null;
                    $off_day_four =$row['off_day_four'] ? $this->transformDate($row['off_day_four'])->format("Y-m-d") : null;
                    // dd($off_day_four);
                   
                         $arr=[
                        'emp_id'=>$employeeid,
                        'off_day_1'=>$off_day_one,
                        'off_day_2'=>$off_day_two,
                        'off_day_3'=>$off_day_three,
                        'off_day_4'=> $off_day_four,
                        ];
                        // dd($arr);
                       
                        Offday::create($arr);

                }
            DB::commit();
            return redirect()->route('offday.index')->with('success','Offday excel import success');
        }

        catch (Exception $e) {
              DB::rollback();
                return redirect()->route('offday.index')
                            ->with('error','Something wrong!');
         }
    }

   public function transformDate($value, $format = 'Y-m-d')
        {
            try {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            } catch (\ErrorException $e) {
                return \Carbon\Carbon::createFromFormat($format, $value);
            }
        }
}