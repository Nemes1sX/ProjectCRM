<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'status', 'startdate', 'enddate', 'project_id'];

    protected $dates = ['startdate', 'enddate'];

    protected $casts = [
        'startdate' => 'date:Y-m-d',
        'enddate' => 'date:Y-m-d'
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
