<?php

namespace App\Providers;

use App\Actions\GetsUserByRole;
use App\Actions\GetUserByRole;
use App\Validators\EditsUserProfileValidator;
use App\Validators\EditUserProfileValidator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
  /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EditsUserProfileValidator::class,EditUserProfileValidator::class);
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
