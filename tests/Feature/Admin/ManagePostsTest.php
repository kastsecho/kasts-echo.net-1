<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    /** @test */
    public function an_admin_can_create_a_post()
    {
        $this->withoutExceptionHandling();

        $this->get('/admin/posts/create')->assertOk();

        $attributes = Post::factory()->raw();

        $this->post('/admin/posts', $attributes)->assertRedirect();
        $this->assertDatabaseHas('posts', $attributes);
        $this->get('/admin/posts')->assertSee($attributes['title']);
    }

    /** @test */
    public function an_admin_can_view_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->get("/admin/posts/$post->id")
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    /** @test */
    public function an_admin_can_edit_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();
        $this->get("/admin/posts/$post->id/edit")->assertOk();

        $attributes = Post::factory()->raw();

        $this->put("/admin/posts/$post->id", $attributes)->assertRedirect();
        $this->assertDatabaseHas('posts', [...$attributes, ...['id' => $post->id]]);
        $this->get("/admin/posts/$post->id")->assertSee($attributes['title']);
    }

    /** @test */
    public function an_admin_can_delete_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();

        $this->delete("/admin/posts/$post->id")->assertRedirect();
        $this->assertSoftDeleted($post);
    }

    /** @test */
    public function an_admin_can_restore_a_post()
    {
        $this->withoutExceptionHandling();

        $post = Post::factory()->create();
        $post->delete();

        $this->put("/admin/posts/$post->id/restore")->assertRedirect();
        $this->assertNotSoftDeleted($post);
    }

    /** @test */
    public function a_post_requires_a_valid_category()
    {
        $post = Post::factory()->create();
        $attributes = Post::factory()->raw(['category_id' => 999]);

        $this->post('/admin/posts', $attributes)->assertInvalid('category_id');
        $this->put("/admin/posts/$post->id", $attributes)->assertInvalid('category_id');
    }

    /** @test */
    public function a_post_requires_a_title()
    {
        $post = Post::factory()->create();
        $attributes = Post::factory()->raw(['title' => '']);

        $this->post('/admin/posts', $attributes)->assertInvalid('title');
        $this->put("/admin/posts/$post->id", $attributes)->assertInvalid('title');
    }

    /** @test */
    public function a_post_requires_a_body()
    {
        $post = Post::factory()->create();
        $attributes = Post::factory()->raw(['body' => '']);

        $this->post('/admin/posts', $attributes)->assertInvalid('body');
        $this->put("/admin/posts/$post->id", $attributes)->assertInvalid('body');
    }
}
