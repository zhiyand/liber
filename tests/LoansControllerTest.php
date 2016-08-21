<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Book;
use App\Loan;

class LoansControllerTest extends TestCase
{
    /** @test */
    public function it_allows_user_to_borrow_a_book()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create([
            'loaned' => 0,
        ]);

        $this->actingAs($user);

        $this->visit(route('books.show', $book->id))
            ->press('Borrow')
            ->seeInDatabase('loans', [
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => 'active',
            ])
            ->seeInDatabase('books', [
                'id' => $book->id,
                'loaned' => 1,
            ]);
    }

    /** @test */
    public function it_denies_loans_over_loan_caps()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create();
        $loans = factory(Loan::class, 6)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $this->visit(route('books.show', $book->id))
            ->press('Borrow')
            ->see('You have reached your loan cap');
    }

    /** @test */
    public function it_rejects_loans_of_outstock_books()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create([
            'quantity' => 2,
            'loaned' => 2
        ]);

        $this->actingAs($user);

        $this->visit(route('books.show', $book->id))
            ->press('Borrow')
            ->see('The book is out of stock');
    }

    /** @test */
    public function it_rejects_double_loans_on_the_same_book()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create([
            'quantity' => 2,
            'loaned' => 0
        ]);
        $user->books()->attach($book, ['expiry' => '', 'status' => 'active']);

        $this->actingAs($user);

        $this->visit(route('books.show', $book->id))
            ->press('Borrow')
            ->see('You already borrowed this book');

    }

    /** @test */
    public function it_allows_users_to_return_their_borrowed_books()
    {
        $user = factory(User::class)->create();
        $book = factory(Book::class)->create();

        $this->actingAs($user);

        $this->visit(route('books.show', $book->id))
            ->press('Borrow')
            ->press('Return Book')
            ->see('Book returned successfully')
            ->seeInDatabase('loans', [
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => 'closed',
            ]);
    }

}
