<?php

namespace App\Actions;

use App\Enums\UserType;
use App\Services\Role\RoleFacade;
use App\Services\User\UserFacade;
use Illuminate\Support\Collection;

class GetUserByRole implements GetsUserByRole
{
    public function __invoke($roleDescription,$eagerAsignees = false):Collection{
        $role = RoleFacade::getByUserType($roleDescription);
        return UserFacade::getByRole($role,$eagerAsignees);
    }
}
