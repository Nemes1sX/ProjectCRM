<?php

namespace App\Exports;

use App\Project;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ProjectExport implements FromQuery
{

    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Project::query()->where('company_id', '=', $this->id);
    }
}
