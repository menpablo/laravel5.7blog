<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    public function setUp()
    {
        parent::setUp(); 
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicCreate()
    {
        $user = factory(User::class)->make(); 
        $savedUser = (new User())->create(array_merge($user->toArray(),['password' => $user->password]));
        $this->assertDatabaseHas('users',['id' => $savedUser->id ]);
    }

     /**
     * A basic test example.
     *
     * @return void
     */
    public function testRelationCreate()
    {
        $supervisor = factory(User::class)->create(['first_name' => 'supervisor']); 
        $asignee    = factory(User::class)->create(['first_name' => 'asignee']); 
        $role       = factory(Role::class)->create(); 

        $asignee->supervisor()->associate($supervisor);
        $asignee->role()->associate($role);

        $asignee->save();
        $this->assertEquals($supervisor->id,$asignee->supervisor->id);
        $this->assertEquals($role->id,$asignee->role->id);

    }
}
