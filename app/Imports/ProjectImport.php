<?php

namespace App\Imports;

use App\Project;
use Maatwebsite\Excel\Concerns\ToModel;

class ProjectImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row, $id)
    {
        return new Project([
            'name' => $row['name'],
            'description' => $row['description'],
            'startdate' => $row['startdate'],
            'enddate' => $row['enddate'],
            'company_id' => $id
        ]);
    }
}
