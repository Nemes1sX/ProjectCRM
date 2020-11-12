<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'status', 'startdate', 'enddate', 'project_id'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
