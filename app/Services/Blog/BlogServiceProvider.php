<?php

namespace App\Services\Blog;

use App\Models\Blog;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {

        // Binds 'SyncBatchService' to the result of the closure
        $this->app->bind('BlogService', function($app)
        {
            return new BlogService(new Blog());
        });
    }
}