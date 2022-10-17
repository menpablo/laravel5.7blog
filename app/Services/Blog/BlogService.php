<?php

namespace App\Services\Blog;

use App\Models\Blog;
use App\Traits\CrudTraits;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    use CrudTraits;

    protected $model;

    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    public function save($data) 
    {
        $blog = new Blog();
        $blog->name        = $data['name'];
        $blog->description = $data['description'];
        $blog->author()->associate(Auth::user()->id);
        return $blog->save();
    }

    public function update($data) 
    {
        $blog = $
        $blog->name        = $data['name'];
        $blog->description = $data['description'];
        $blog->author()->associate(Auth::user()->id);
        return $blog->save();
    }
}