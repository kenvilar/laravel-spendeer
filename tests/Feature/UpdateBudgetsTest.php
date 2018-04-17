<?php

namespace Tests\Feature;

use App\Budget;
use App\Category;
use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
}
