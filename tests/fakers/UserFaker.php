<?php

namespace Tests\fakers;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;

class UserFaker
{
    public static function createBlogger(){
        

        $bloggerRole = factory(Role::class)->create(['description' => UserType::BLOGGER]);
        $bloggerUser = factory(User::class)->make(); 
        $bloggerUser->role()->associate($bloggerRole)->first(); 
        $bloggerUser->save();
        $bloggerUser->supervisor()->associate(self::createSupervisor());
        return $bloggerUser;
    }

    public static function createSupervisor(){
        $supervisorRole = factory(Role::class)->create(['description' => UserType::SUPERVISOR]);
        $supervisorUser = factory(User::class)->make(); 
        $supervisorUser->role()->associate($supervisorRole)->first();   
        $supervisorUser->save();
        return $supervisorUser;
    }

    public static function createAdmin(){
        $bloggerRole = factory(Role::class)->create(['description' => UserType::ADMIN]);
        $bloggerUser = factory(User::class)->make(); 
        $bloggerUser->role()->associate($bloggerRole)->first();      
        $bloggerUser->save();  
        return $bloggerUser;
    }
}
