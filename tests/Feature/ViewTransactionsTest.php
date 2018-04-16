<?php

namespace Tests\Feature;

use App\Category;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_allows_only_authenticated_users_to_see_transactions_list()
    {
        $this->signOut()
            ->withExceptionHandling()
            ->get('/transactions')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function it_only_displays_transactions_that_belong_to_current_logged_in_user()
    {
        $otherUser = createFactory(User::class);

        $transactions = createFactory(Transaction::class, ['user_id' => $this->user->id]);

        $otherTransaction = createFactory(Transaction::class, ['user_id' => $otherUser->id]);

        $this->get('/transactions')
            ->assertSee($transactions->description)
            ->assertDontSee($otherTransaction->description);
    }

    /**
     * @test
     */
    public function it_can_display_all_transactions()
    {
        $transaction = $this->createFactory(Transaction::class);

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /**
     * @test
     */
    public function it_can_filter_transactions_by_category()
    {
        $category = createFactory(Category::class);
        $transaction = $this->createFactory(Transaction::class, ['category_id' => $category->id]);
        $otherTransaction = $this->createFactory(Transaction::class);

        $this->get('/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }

    /**
     * @test
     */
    public function it_can_filter_transaction_by_month()
    {
        $transaction = $this->createFactory(Transaction::class);
        $pastTransaction = $this->createFactory(Transaction::class,
            ['created_at' => Carbon::now()->subMonth(2)]);
        
        $this->get('/transactions?month=' . Carbon::now()->subMonth(2)->format('M') )
            ->assertSee($pastTransaction->description)
            ->assertDontSee($transaction->description);
    }

    /**
     * @test
     */
    public function it_can_filter_transaction_by_month_by_default()
    {
        $transaction = $this->createFactory(Transaction::class);
        $pastTransaction = $this->createFactory(Transaction::class,
            ['created_at' => Carbon::now()->subMonth(2)]);

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertDontSee($pastTransaction->description);
    }
}
