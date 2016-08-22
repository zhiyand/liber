<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class UsersTest extends TestCase
{
    /** @test */
    public function it_allows_admin_to_create_new_users()
    {
        $admin = factory(User::class)->create(['role' => 'librarian']);

        $this->actingAs($admin);

        $this->visit('/users/create')
            ->type('Mr. Smart', 'name')
            ->type('foo@example.com', 'email')
            ->type('2006-08-08', 'birthday')
            ->select('librarian', 'role')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Add');

        $this->seeInDatabase('users', [
            'name' => 'Mr. Smart',
            'email' => 'foo@example.com',
            'birthday' => '2006-08-08 00:00:00',
            'role' => 'librarian',
        ]);
    }

    /** @test */
    public function it_allows_admin_to_edit_users()
    {
        $admin = factory(User::class)->create(['role' => 'librarian']);
        $user = factory(User::class)->create([
            'name' => 'Mr. Smart',
            'email' => 'foo@example.com',
            'birthday' => '2006-08-08 00:00:00',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($admin);

        $this->visit(route('users.edit', $user->id))
            ->type('Mr. Foo', 'name')
            ->type('bar@example.com', 'email')
            ->type('2006-09-09', 'birthday')
            ->select('librarian', 'role')
            ->press('Update');

        // Details changed
        $this->seeInDatabase('users', [
            'name' => 'Mr. Foo',
            'email' => 'bar@example.com',
            'birthday' => '2006-09-09 00:00:00',
            'role' => 'librarian',
        ]);

        $login = auth()->once([
            'email' => 'bar@example.com',
            'password' => 'password',
        ]);

        // Password not changed
        $this->assertTrue($login);

        // Change password
        $this->visit(route('users.edit', $user->id))
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->press('Update');

        $login = auth()->once([
            'email' => 'bar@example.com',
            'password' => '123456',
        ]);

        // Password changed
        $this->assertTrue($login);
    }

    /** @test */
    public function it_allows_admin_to_delete_users()
    {
        $admin = factory(User::class)->create(['role' => 'librarian']);
        $user = factory(User::class)->create();

        $this->actingAs($admin);

        $this->visit('/users')
            ->press('delete-user-' . $user->id);

        $this->assertNull(User::find($user->id));
    }

    /** @test */
    public function it_rejects_user_to_create_or_edit_users()
    {
        $user = factory(User::class)->create(['role' => 'user']);
        $user2 = factory(User::class)->create(['role' => 'user']);

        $this->actingAs($user);

        $this->visit('/users')
            ->see('Permission denied');

        $this->visit(route('users.edit', $user2->id))
            ->see('Permission denied');
    }

}
