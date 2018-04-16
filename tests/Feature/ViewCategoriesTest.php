<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_display_categories()
    {
        $categories = $this->createFactory(Category::class);
        
        $this->get('/categories')
            ->assertSee($categories->name);
    }
}
