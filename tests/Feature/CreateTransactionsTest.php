<?php

namespace Tests\Feature;

use App\Category;
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
        $category = $this->createFactory(Category::class);

        $transactions = $this->makeFactory(Transaction::class, ['category_id' => $category->id]);

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
        $this->postTransaction(['description' => null])->assertSessionHasErrors('description');
    }

    /**
     * @test
     */
    public function it_cannot_create_a_transaction_without_category()
    {
        $this->postTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     */
    public function it_cannot_create_a_transaction_without_valid_amount()
    {
        $this->postTransaction(['amount' => 'thisIsString'])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     */
    public function it_cannot_create_a_transaction_without_amount()
    {
        $this->postTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    protected function postTransaction($overrides = [])
    {
        $transactions = makeFactory(Transaction::class, $overrides);

        return $this->withExceptionHandling()->post('/transactions', $transactions->toArray());
    }
}
