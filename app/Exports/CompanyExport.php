<?php

namespace App\Exports;

use App\Company;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyExport implements FromQuery, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Company::query()->select('name','ceoname','size','industry');
    }
    public function headings(): array
    {
        return ['Name', 'Ceo Name', 'Size', 'Industry'];
    }
}
