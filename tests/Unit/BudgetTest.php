<?php

namespace Tests\Unit;

use App\Budget;
use App\Category;
use App\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_has_a_balance()
    {
        $category = $this->createFactory(Category::class);
        $transactions = $this->createFactory(Transaction::class, ['category_id' => $category->id], 3);
        $budget = $this->createFactory(Budget::class, ['category_id' => $category->id]);

        $expectedBalance = $budget->amount - $transactions->sum('amount');
        
        $this->assertEquals($expectedBalance, $budget->balance());
    }
}
