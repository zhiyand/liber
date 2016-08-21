<?php

use Illuminate\Database\Seeder;

use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $covers = [
            'covers/1.jpg',
            'covers/2.jpg',
            'covers/3.gif',
            'covers/4.jpg',
            'covers/5.jpg',
            'covers/6.png',
            'covers/7.png',
            'covers/8.jpg',
            'covers/9.jpg',
        ];

        foreach($covers as $cover){
            factory(Book::class)->create([
                'cover' => $cover,
            ]);
        }
    }
}
