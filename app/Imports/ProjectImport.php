<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectImport implements ToCollection, WithHeadingRow
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

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            Project::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'startdate' => Date::excelToDateTimeObject($row['start_date']),
                'enddate' => Date::excelToDateTimeObject($row['end_date']),
                'company_id' => $this->company_id
            ]);
        }
    }
}
