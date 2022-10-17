<?php

namespace App\Providers;

use App\Actions\GetsUserByRole;
use App\Actions\GetUserByRole;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
  /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(GetsUserByRole::class,GetUserByRole::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
