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

    /**
     * @test
     */
    public function it_cannot_create_a_transaction_without_description()
    {
        $transactions = makeFactory(Transaction::class, ['description' => null]);

        $this->post('/transactions', $transactions->toArray())
            ->assertSessionHasErrors('description');
    }
}
