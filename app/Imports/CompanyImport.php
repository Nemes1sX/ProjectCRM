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
            'name' => $row['name'],
            'ceoname' => $row['ceoname'],
            'size' => $row['size'],
            'industry' => $row['industry']
        ]);
    }
}
