<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /** @test */
    public function a_user_can_view_all_posts()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->get('/blog')->assertSee($post->title);
    }

    /** @test */
    public function a_user_can_read_a_single_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->get("/blog/$post->id")
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    /** @test */
    public function a_user_can_filter_posts_by_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->hasPosts(2)->create();
        $post = Post::factory()->create();

        $this->get("/blog?category=$category->id")->assertDontSee($post->title);
    }
}
