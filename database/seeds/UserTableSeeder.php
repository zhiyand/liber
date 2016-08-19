<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Zhiyan',
            'email' => 'dzy0451@gmail.com',
            'password' => bcrypt('password'),
            'birthday' => '1987-01-17',
            'role' => 'administrator',
        ]);
    }
}
