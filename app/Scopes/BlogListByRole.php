<?php

namespace App\Scopes;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\UserTest;

class BlogListByRole implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        switch (Auth::user()->role->description) {
            case UserType::ADMIN:
                break;
            case UserType::SUPERVISOR:
                $this->supervisorScope($builder,$model);  
                break;
            case UserType::BLOGGER:
                $this->bloggerScope($builder,$model);    
                break;
        }
    }

    private function bloggerScope(Builder $builder, Model $model){
        $builder->where('user_id',Auth::user()->id);    
    }

    private function supervisorScope(Builder $builder, Model $model){
        $builder->orwhere('user_id',Auth::user()->id);   
        $builder->orwhereIn('user_id',function ($query) {
                        $query->select('id')
                                ->from('users')
                                ->Where('users.supervisor_id',Auth::user()->id);
        });
    }
}
