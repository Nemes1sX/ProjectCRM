<?php

namespace App\Imports;

use App\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
 use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectImport implements ToCollection, WithHeadingRow, WithMapping
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct(int $company_id)
    {
        $this->company_id = $company_id;
    }

    public function map($row) : array
    {
        if(gettype($row['start_date']) == 'string' || gettype($row['end_date'])  == 'string'){
            $row['start_date'] = Date::excelToDateTimeObject($row['start_date']);
            $row['end_date'] = Date::excelToDateTimeObject($row['end_date']);
        }

        return $row;
    }

    public function collection(Collection $rows)
    {

        Validator::make($rows->toArray(), [
            '*.name' => 'required',
             '*.description' => 'required',
            '*.start_date.*' => 'required|date',
            '*.end_date.*' => 'required|date|after_or_equal:start_date',
        ])->validate();

        foreach ($rows as $row) {

            Project::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'startdate' =>  Date::excelToDateTimeObject($row['start_date']),
                'enddate' =>  Date::excelToDateTimeObject($row['end_date']),
                'company_id' => $this->company_id
            ]);
        }
    }
}
