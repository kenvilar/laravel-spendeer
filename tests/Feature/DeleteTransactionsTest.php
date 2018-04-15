<?php

namespace Tests\Feature;

use App\Transaction;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_delete_transactions()
    {
        $transaction = $this->createFactory(Transaction::class);
        
        $this->delete('/transactions/' . $transaction->id)
            ->assertRedirect('/transactions');
        
        $this->get('/transactions')
            ->assertDontSee($transaction->description);
    }
}
