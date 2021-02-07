<?php

namespace App\Imports;

use App\Company;
use Maatwebsite\Excel\Concerns\ToModel;

class CompanyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Company([
            'name' => $row[0],
            'ceoname' => $row[1],
            'size' => $row[2],
            'industry' => $row[3]
        ]);
    }
}
