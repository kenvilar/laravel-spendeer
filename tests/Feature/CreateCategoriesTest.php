<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_categories()
    {
        $categories = $this->makeFactory(Category::class);

        $this->post('/categories', $categories->toArray())
            ->assertRedirect('/categories');


        $this->get('/categories')
            ->assertSee($categories->name);
    }

    /**
     * @test
     */
    public function it_cannot_create_a_categories_without_name()
    {
        $this->postcategory(['name' => null])->assertSessionHasErrors('name');
    }

    protected function postcategory($overrides = [])
    {
        $category = makeFactory(Category::class, $overrides);

        return $this->withExceptionHandling()->post('/categories', $category->toArray());
    }
}
