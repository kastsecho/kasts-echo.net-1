<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Post;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /** @test */
    public function it_consists_of_posts()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($category->posts->contains($post));
    }
}
