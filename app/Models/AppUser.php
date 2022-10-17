<?php

namespace App\Models;

use App\Enums\UserType;
use App\Scopes\FilterAsignees;
use App\Scopes\UserWithSupervisor;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUser extends User
{
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope(new FilterAsignees());
    // }
}
