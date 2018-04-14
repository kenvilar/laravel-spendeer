<?php

namespace Tests\Feature;

use App\Category;
use App\Transaction;
use App\User;
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
    public function it_allows_only_authenticated_users()
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
        $transaction = createFactory(Transaction::class, ['user_id' => $this->user->id]);

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
        $transaction = createFactory(Transaction::class, ['category_id' => $category->id, 'user_id' => $this->user->id]);
        $otherTransaction = createFactory(Transaction::class);

        $this->get('/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }
}
