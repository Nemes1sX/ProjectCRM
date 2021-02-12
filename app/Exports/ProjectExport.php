<?php

namespace App\Exports;

use App\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectExport implements FromQuery, WithHeadings
{

    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Project::query()->where('company_id', '=', $this->id)->select('name','description','startdate', 'enddate');
    }
    public function headings(): array
    {
        return ['Name', 'Description', 'Start Date', 'End Date'];
    }
}
