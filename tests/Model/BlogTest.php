<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    public function testBasicCreateBlog()
    {
        $blog = factory(Blog::class)->make(); 
        $savedBlog = (new Blog())->create($blog->toArray());
        $this->assertDatabaseHas('blogs',['id' => $savedBlog->id ]);
    }

    public function testRelationBlogAuthorCreate()
    {
        $blog = factory(Blog::class)->make(['name' => 'blog']); 
        $author = factory(User::class)->create(['first_name' => 'author']); 
        $blog->author()->associate($author);
        $blog->save();
        $this->assertEquals($author->id,$blog->author->id);
        $this->assertEquals('author',$blog->author->first_name);

    }
}
