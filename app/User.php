<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Task;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function  getJWTCustomClaims()
    {
        return [];
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function workHours($query)
    {
        return $query->addSelect([
            'estimated_time' => Task::selectRaw('sum(estimated_time) as total')
                ->whereColumn('user_id', 'users.id')
                ->groupBy('user_id')
        ])
            ->orderBy('estimated_time', 'asc');

    }
}
