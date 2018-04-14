<?php

namespace Tests\Feature;

use App\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * @test
     */
    public function it_can_create_transactions()
    {
        $transactions = makeFactory(Transaction::class);

        $this->post('/transactions', $transactions->toArray())
            ->assertRedirect('/transactions');


        $this->get('/transactions')
            ->assertSee($transactions->description);
    }
}
