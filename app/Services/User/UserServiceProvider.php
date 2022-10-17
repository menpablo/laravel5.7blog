<?php

namespace App\Services\User;

use App\Models\AppUser;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Binds 'SyncBatchService' to the result of the closure
        $this->app->bind('UserService', function($app)
        {
            return new UserService(new AppUser());
        });
    }
}