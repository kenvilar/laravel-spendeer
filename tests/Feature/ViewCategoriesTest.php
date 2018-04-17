<?php

namespace Tests\Feature;

use App\Category;
use App\User;
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

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_see_categories_list()
    {
        $this->signOut()
            ->withExceptionHandling()
            ->get('/categories')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_categories_that_belong_to_current_logged_in_user()
    {
        $otherUser = createFactory(User::class);

        $category = $this->createFactory(Category::class);

        $otherCategory = createFactory(Category::class, ['user_id' => $otherUser->id]);

        $this->get('/categories')
            ->assertSee($category->name)
            ->assertDontSee($otherCategory->name);
    }
}
