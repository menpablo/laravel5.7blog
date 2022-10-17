<?php

namespace App\Services\Role;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Binds 'SyncBatchService' to the result of the closure
        $this->app->bind('RoleService', function($app)
        {
            return new RoleService(new Role());
        });
    }
}