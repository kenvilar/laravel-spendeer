<?php

namespace Tests\Feature;

use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_update_transactions()
    {
        $transaction = $this->createFactory(Transaction::class);
        $newTransaction = $this->makeFactory(Transaction::class);

        $this->patch("/transactions/{$transaction->id}", $newTransaction->toArray())
            ->assertRedirect("/transactions");
        
        $this->get("/transactions")
            ->assertSee($newTransaction->description);
    }
}
