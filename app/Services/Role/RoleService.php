<?php

namespace App\Services\Role;

use App\Models\Blog;
use App\Models\Role;
use App\Traits\CrudTraits;

class RoleService
{
    use CrudTraits;

    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    function getByUserType($userType){
        return $this->model->where('description',$userType)->first();
    }
}