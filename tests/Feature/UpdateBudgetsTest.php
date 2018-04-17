<?php

namespace Tests\Feature;

use App\Budget;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_budgets()
    {
        $category = $this->createFactory(Category::class);
        $budget = $this->createFactory(Budget::class, ['category_id' => $category->id]);
        $newBudget = $this->makeFactory(Budget::class, ['category_id' => $category->id]);

        $this->patch("/budgets/{$budget->id}", $newBudget->toArray())
            ->assertRedirect("/budgets");

        $this->get("/budgets")
            ->assertSee((string)$newBudget->amount);
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_a_category()
    {
        $this->updateBudget(['category_id' => null])
            ->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_an_amount()
    {
        $this->updateBudget(['amount' => null])
            ->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function it_cannot_update_budgets_without_a_budget_date()
    {
        $this->updateBudget(['budget_date' => null])
            ->assertSessionHasErrors('budget_date');
    }

    protected function updateBudget($overrides = [])
    {
        $category = $this->createFactory(Category::class);
        $budget = $this->createFactory(Budget::class, ['category_id' => $category->id]);
        $newBudget = $this->makeFactory(Budget::class, array_merge(['category_id' => $category->id], $overrides));

        return $this->withExceptionHandling()
            ->patch("/budgets/{$budget->id}", $newBudget->toArray());
    }
}
