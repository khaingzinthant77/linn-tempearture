<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class EmployeeExport implements FromCollection, WithHeadings, WithEvents ,ShouldAutoSize{
    public function __construct($header,$data,$drawings = [])
    {
        $this->header = $header;
        $this->data = $data;
        $this->drawings = $drawings;
    }

    public function headings(): array
    {
       return [
            "Photo",
            "Employee ID",
            'Name',
            'Father Name',
            'DOB',
            'Rank',
            'Department',
            'Branch',
            'Join_Date',
            'Phone',
            'Address'
           
        ];
    }

    public function registerEvents(): array
    {
        $count = [
            count($this->data[0]), //column count
            count($this->drawings)?count($this->data):0 //row count, if there are images
        ];
        $drawings = $this->drawings;

        return [
            AfterSheet::class => function(AfterSheet $event) use($count, $drawings) {
                //Freeze frist row
                $event->sheet->freezePane('A2', 'A2');

                //Set auto width for the rest
                $columnindex = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
                                     'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
                                     'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ');
                for($i=0;$i<$count[0];$i++) //iterate based on column count
                {
                    if($i>76) break;

                    if($count[1] && $i==0) // Exception for image column, if there are images
                        $event->sheet->getColumnDimension('A')->setWidth(17);
                    else
                        $event->sheet->getColumnDimension($columnindex[$i])->setAutoSize(true);
                }

                //Set row height
                for($i=0;$i<$count[1];$i++) //iterate based on row count
                {
                    $event->sheet->getRowDimension($i+2)->setRowHeight(60);
                }

                if($count[1])
                foreach($drawings as $k=>$drawing_temp)
                {
                    if($drawing_temp)
                    {
                        if($img_file = public_path('/uploads/employeePhoto/'.$drawing_temp['photo']))
                        {
                            $drawing = new Drawing();
                            $drawing->setName('image');
                            $drawing->setDescription('image');
                            $drawing->setPath($img_file);
                            $drawing->setHeight(70);
                            $drawing->setOffsetX(5);
                            $drawing->setOffsetY(5);
                            $drawing->setCoordinates('A'.($k+2));
                            $drawing->setWorksheet($event->sheet->getDelegate());
                        }
                    }
                }
            },
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }
}
