<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Http\Request;

interface EditsUserProfileValidator
{
    public function __invoke(Request $request,User $user);

}
