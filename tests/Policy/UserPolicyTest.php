<?php

namespace Tests\Unit;

use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\fakers\UserFaker;

class UserPolicyTest extends TestCase
{   
    protected $policy;
    protected $adminUser;
    protected $supervisorUser;
    protected $bloggerUser;


    use DatabaseTransactions;
    public function setUp()
    {
        parent::setUp(); 
        $this->policy = new UserPolicy();        

        $this->adminUser = UserFaker::createAdmin();
        $this->supervisorUser = UserFaker::createSupervisor();
        $this->bloggerUser = UserFaker::createBlogger();
    }

    public function testWorkWithUsersForAdminRole()
    {
        $this->assertTrue($this->policy->work_with_users($this->adminUser));
        $this->assertFalse($this->policy->work_with_users($this->supervisorUser));

    }

    public function testCanSeeUsers()
    {
        $this->assertTrue($this->policy->can_see_users($this->adminUser));
        $this->assertTrue($this->policy->can_see_users($this->supervisorUser));
        $this->assertFalse($this->policy->can_see_users($this->bloggerUser));
    }    

    public function testCanSeeSupervisors()
    {
        $this->assertTrue($this->policy->can_see_supervisors($this->adminUser));
        $this->assertFalse($this->policy->can_see_supervisors($this->supervisorUser));
        $this->assertFalse($this->policy->can_see_supervisors($this->bloggerUser));
    }   

    public function testShow()
    {
        $this->assertTrue($this->policy->can_see_supervisors($this->adminUser));
        $this->assertFalse($this->policy->can_see_supervisors($this->supervisorUser));
        $this->assertFalse($this->policy->can_see_supervisors($this->bloggerUser));
    }       
}

