<?php

namespace App\Exports;

use App\Salary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalaryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    { 
        $salary = new Salary();
       
        $dep_id = (!empty($_POST['dep_id']))?$_POST['dep_id']:'';
  
        $salary = $salary->leftjoin('department','department.id','=','employee.dep_id');


        if($dep_id!=''){
            $salary = $salary->where('employee.dep_id',$dep_id);
        }

        $salarys =$salary->select(
                           'salary.emp_id',
                           'salary.name',
                           'salary.department',
                           'salary.branch',
                           'salary.pay_date',
                           'salary.year',
                           'salary.salary_amt',
                           'salary.bonus',
                           'salary.month_total',
                         
                           )->get();
        // dd($items->get());
        return $salarys;
    }

    public function headings(): array
    {
        return [
            "Employee Id",
            'Name',
            'Department',
            'Branch',
            'Pay Month',
            'Pay Year',
            'Salary Amount',
            'Bonus',
            'Toatal Amount',
           
           
        ];
    }
}