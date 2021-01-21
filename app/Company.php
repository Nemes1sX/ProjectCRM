<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'ceoname', 'industry', 'size'];

    public function tasks()
    {
        return $this->hasManyThrough(
            'App\Project',
            'App\Task',
            'company_id',
            'project_id',
            'id',
            'id'
        );
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }
}
