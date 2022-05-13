<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Tests\TestCase;

class ManageCategoriesTest extends TestCase
{
    /** @test */
    public function an_admin_can_create_a_category()
    {
        $this->withoutExceptionHandling();

        $this->get('/admin/categories/create')->assertOk();

        $attributes = Category::factory()->raw();

        $this->post('/admin/categories', $attributes)->assertRedirect();
        $this->assertDatabaseHas('categories', $attributes);
        $this->get('/admin/categories')->assertSee($attributes['name']);
    }

    /** @test */
    public function an_admin_can_view_a_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->get("/admin/categories/$category->id")
            ->assertSee($category->name)
            ->assertSee($category->slug);
    }

    /** @test */
    public function an_admin_can_edit_a_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $this->get("/admin/categories/$category->id/edit")->assertOk();

        $attributes = Category::factory()->raw();

        $this->put("/admin/categories/$category->id", $attributes)->assertRedirect();
        $this->assertDatabaseHas('categories', [...$attributes, ...['id' => $category->id]]);
        $this->get("/admin/categories/$category->id")->assertSee($attributes['name']);
    }

    /** @test */
    public function an_admin_can_delete_a_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->delete("/admin/categories/$category->id")->assertRedirect();
        $this->assertSoftDeleted($category);
    }

    /** @test */
    public function an_admin_can_restore_a_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $category->delete();

        $this->put("/admin/categories/$category->id/restore")->assertRedirect();
        $this->assertNotSoftDeleted($category);
    }

    /** @test */
    public function a_category_requires_a_name()
    {
        $category = Category::factory()->create();
        $attributes = Category::factory()->raw(['name' => '']);

        $this->post('/admin/categories', $attributes)->assertInvalid('name');
        $this->put("/admin/categories/$category->id", $attributes)->assertInvalid('name');
    }

    /** @test */
    public function a_category_requires_a_slug()
    {
        $category = Category::factory()->create();
        $attributes = Category::factory()->raw(['slug' => '']);

        $this->post('/admin/categories', $attributes)->assertInvalid('slug');
        $this->put("/admin/categories/$category->id", $attributes)->assertInvalid('slug');
    }
}
