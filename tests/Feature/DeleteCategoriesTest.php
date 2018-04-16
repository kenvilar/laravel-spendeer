<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_delete_categories()
    {
        $category = $this->createFactory(Category::class);

        $this->delete('/categories/' . $category->slug)
            ->assertRedirect('/categories');

        $this->get('/categories')
            ->assertDontSee($category->name);
    }
}
