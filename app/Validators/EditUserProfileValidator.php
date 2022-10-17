<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditUserProfileValidator implements EditsUserProfileValidator
{
    public function __invoke(Request $request,User $user ){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email',  Rule::unique('users')->ignore($user->id)]
        ])->validate();
    }
}
