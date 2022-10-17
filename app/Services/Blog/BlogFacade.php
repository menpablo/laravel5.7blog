<?php

namespace App\Services\Blog;

use Illuminate\Support\Facades\Facade;

class BlogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BlogService';
    }
}
