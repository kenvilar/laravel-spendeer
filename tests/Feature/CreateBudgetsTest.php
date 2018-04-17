<?php

namespace Tests\Feature;

use App\Budget;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_create_budgets()
    {
        $category = $this->createFactory(Category::class);
        $budget = $this->makeFactory(Budget::class, ['category_id' => $category->id]);

        $this->post('/budgets', $budget->toArray())
            ->assertRedirect('/budgets');


        $this->get('/budgets')
            ->assertSee((string)$budget->amount);
    }
}
