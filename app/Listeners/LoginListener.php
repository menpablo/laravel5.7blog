<?php

namespace App\Listeners;

use App\Services\User\UserFacade;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class LoginListener
{
    public function handle(Login $event)
    {
        $data = [
            'last_login'    => Carbon::now()->toDateTimeString()
        ];
        UserFacade::update($data,Auth::user()->id);
    }
}