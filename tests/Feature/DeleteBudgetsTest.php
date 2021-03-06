<?php

namespace Tests\Feature;

use App\Budget;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_delete_budgets()
    {
        $budget = $this->createFactory(Budget::class);

        $this->delete('/budgets/' . $budget->id)
            ->assertRedirect('/budgets');

        $this->get('/budgets')
            ->assertDontSee((string)$budget->amount);
    }
}
