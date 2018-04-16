<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
