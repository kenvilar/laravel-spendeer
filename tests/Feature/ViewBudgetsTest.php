<?php

namespace Tests\Feature;

use App\Budget;
use App\Category;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_should_display_budgets_for_the_current_month_by_default()
    {
        $category = $this->createFactory(Category::class);
        $budgetForThisMonth = $this->createFactory(Budget::class, ['category_id' => $category->id]);
        $budgetForLastMonth = $this->createFactory(Budget::class,
            ['category_id' => $category->id, 'budget_date' => Carbon::now()->subMonth(1)]);

        $this->get('/budgets')
            ->assertSee((string)$budgetForThisMonth->amount)
            ->assertSee((string)$budgetForThisMonth->balance())
            ->assertDontSee((string)$budgetForLastMonth->amount)
            ->assertDontSee((string)$budgetForLastMonth->balance());
    }

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_see_budget_list()
    {
        $this->signOut()
            ->withExceptionHandling()
            ->get('/budgets')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_budgets_that_belong_to_current_logged_in_user()
    {
        $category = $this->createFactory(Category::class);

        $otherUser = createFactory(User::class);

        $budget = createFactory(Budget::class,
            ['user_id' => $this->user->id, 'category_id' => $category->id]);

        $otherBudget = createFactory(Budget::class, ['user_id' => $otherUser->id]);

        $this->get('/budgets')
            ->assertSee((string)$budget->amount)
            ->assertDontSee((string)$otherBudget->amount);
    }
}
