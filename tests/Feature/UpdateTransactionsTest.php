<?php

namespace Tests\Feature;

use App\Category;
use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_transactions()
    {
        $category = $this->createFactory(Category::class);
        $transaction = $this->createFactory(Transaction::class);
        $newTransaction = $this->makeFactory(Transaction::class, ['category_id' => $category->id]);

        $this->patch("/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertRedirect("/transactions");

        $this->get("/transactions")
            ->assertSee($newTransaction->description);
    }

    /**
     * @test
     */
    public function it_cannot_update_a_transaction_without_description()
    {
        $this->updateTransaction(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function it_cannot_update_a_transaction_without_category()
    {
        $this->updateTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function it_cannot_update_a_transaction_without_valid_amount()
    {
        $this->updateTransaction(['amount' => 'thisIsString'])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function it_cannot_update_a_transaction_without_amount()
    {
        $this->updateTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    protected function updateTransaction($overrides = [])
    {
        $transaction = $this->createFactory(Transaction::class);
        $newTransaction = $this->makeFactory(Transaction::class, $overrides);

        return $this->withExceptionHandling()
            ->patch("/transactions/{$transaction->id}", $newTransaction->toArray());
    }
}
