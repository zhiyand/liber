<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Book;

class BooksControllerTest extends TestCase
{
    /** @test */
    public function it_allows_admin_to_add_a_book()
    {
        $admin = factory(User::class)->create([
            'role' => 'librarian',
        ]);

        $this->actingAs($admin);
        $this->createBook('Dummy Book');

        $this->visit('/books/1')
            ->see('Dummy Book');
    }


    /** @test */
    public function it_allows_admin_to_edit_a_book()
    {
        $admin = factory(User::class)->create([
            'role' => 'librarian',
        ]);

        $this->actingAs($admin);
        $book = factory(Book::class)->create();

        $this->visit("/books/{$book->id}/edit")
            ->see($book->title)
            ->type('title updated', 'title')
            ->attach(__DIR__ . '/files/cover.jpg', 'cover')
            ->press('Update');

        $this->visit("/books/{$book->id}")
            ->see('title updated');
    }

    /** @test */
    public function it_allows_admin_to_delete_a_book()
    {
        $admin = factory(User::class)->create([
            'role' => 'librarian',
        ]);

        $this->actingAs($admin);
        $book = factory(Book::class)->create();

        $this->visit("/books/{$book->id}")
            ->press('Delete');

        $this->visit("/books/{$book->id}")
            ->see('Page not found');
    }

    /** @test */
    public function it_denies_user_to_add_a_book()
    {
        $user = factory(User::class)->create([
            'role' => 'user',
        ]);

        $this->actingAs($user);

        $this->visit('/books/create')
            ->see('Permission Denied!');
    }

    protected function createBook($title)
    {
        $this->visit('/books/create')
            ->type($title, 'title')
            ->type('John Doe', 'author')
            ->type('123456', 'isbn')
            ->type('10', 'quantity')
            ->type('#5-22', 'shelf')
            ->type('Dummy Description', 'description')
            ->attach(__DIR__ . '/files/cover.jpg', 'cover')
            ->press('Add');

        return $this;
    }
}
