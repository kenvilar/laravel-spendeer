<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_categories()
    {
        $category = $this->createFactory(Category::class);
        $newCategory = $this->makeFactory(Category::class);

        $this->patch("/categories/{$category->slug}", $newCategory->toArray())
            ->assertRedirect("/categories");

        $this->get("/categories")
            ->assertSee($newCategory->name);
    }

    /**
     * @test
     */
    public function it_cannot_update_a_category_without_name()
    {
        $this->updateCategory(['name' => null])
            ->assertSessionHasErrors('name');
    }

    protected function updateCategory($overrides = [])
    {
        $category = $this->createFactory(Category::class);
        $newCategory = $this->makeFactory(Category::class, $overrides);

        return $this->withExceptionHandling()
            ->patch("/categories/{$category->slug}", $newCategory->toArray());
    }
}
