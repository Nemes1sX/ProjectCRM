<?php

namespace App\Imports;

use App\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CompanyImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        Validator::make($rows->toArray(),[
            'name' => 'required|max:40',
            'ceoname' => 'required|max:40',
            'industry' => 'required',
            'size' => 'required',
        ]);


        foreach($rows as $row) {

            Company::create([
                'name' => $row['name'],
                'ceoname' => $row['ceoname'],
                'size' => $row['size'],
                'industry' => $row['industry']
            ]);
        }
    }
}
