<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'startdate', 'enddate', 'company_id'];

    protected $dates = ['startdate', 'enddate'];

    protected $hidden = ['id', 'company_id', 'created_at','updated_at'];

    protected $casts = [
        'startdate' => 'date:Y-m-d',
        'enddate' => 'date:Y-m-d'
    ];

    public function tasks()
    {
        return $this->hasMany('App\Task', 'project_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
