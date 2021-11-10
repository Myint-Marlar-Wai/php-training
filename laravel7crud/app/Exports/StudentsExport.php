<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection,WithHeadings
{
    public function headings():array
    {
        return [
            "id",
            "full_name",
            "image",
            "phone_no",
            "address"
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Student::all();
        return collect(Student::getStudent());
    }
}
