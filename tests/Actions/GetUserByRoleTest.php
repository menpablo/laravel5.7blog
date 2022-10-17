<?php

namespace Tests\Feature;

use App\Actions\GetUserByRole;
use App\Enums\UserType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetUserByRoleTestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUserByRoleTestTest()
    {
        $result = (new GetUserByRole())(UserType::SUPERVISOR);
        $this->assertGreaterThan(0,$result->count());
    }
}
