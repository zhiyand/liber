<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Book;
use App\User;

class SearchTest extends TestCase
{
    /** @test */
    public function it_searches_books_by_title_and_author()
    {
        $this->actingAs(factory(User::class)->create());

        factory(Book::class, 1)->create(['title' => 'Learning Programming', 'author' => 'John Doe']);
        factory(Book::class, 1)->create(['title' => 'How to cook', 'author' => 'Mr. Smart']);

        $this->visit('/books')
            ->type('programming', 'q')
            ->press('btn-search')
            ->see('Learning Programming')
            ->see('John Doe')
            ->dontSee('How to cook');

        $this->visit('/books')
            ->type('smart', 'q')
            ->press('btn-search')
            ->see('How to cook')
            ->see('Mr. Smart')
            ->dontSee('Learning Programming');
    }
}
