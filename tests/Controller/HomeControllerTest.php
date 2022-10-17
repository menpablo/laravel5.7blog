<?php

namespace Tests\Feature;

use App\Models\Blog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\fakers\UserFaker;

class HomeControllerTest extends TestCase
{

    public function testBloggerUserMenu()
    {
        $blogger = UserFaker::createBlogger();
        $blogs = factory(Blog::class)->create(['user_Id' =>$blogger->id],5);
        $response = $this->actingAs($blogger)
                         ->get('/home');

        $response->assertStatus(200);
        $response->assertViewIs('home');
        //validate menu
        $response->assertSeeTextInOrder(['Home','Blogs']);
        $response->assertSee('Dashboard');

        //validate profile card
        $response->assertSeeTextInOrder([
            $blogger->first_name,
            $blogger->last_name,
            $blogger->email,
            'Supervisor',
            $blogger->supervisor->first_name,
            $blogger->supervisor->last_name,
            'Blogs Quatity',
            $blogs->count(),
            'Last Login',
            $blogger->last_login
        ]);
    }
}
