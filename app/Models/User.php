<?php

namespace App\Models;

use App\Enums\UserType;
use App\Scopes\FilterAsignees;
use App\Scopes\UserWithSupervisor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'first_name',
       'last_name',
       'email',
       'email_verified_at',
       'last_login',
       'last_login_ip',
       'password',
       'supervisor_id',
       'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog');
    }

    public function assignees()
    {
        return $this->hasMany('App\Models\User','supervisor_id');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\Models\User','supervisor_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }     
}
