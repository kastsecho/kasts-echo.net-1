<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_belongs_to_a_category()
    {
        $post = Post::factory()->create();

        $this->assertInstanceOf(Category::class, $post->category);
    }
}
