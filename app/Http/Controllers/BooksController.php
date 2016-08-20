<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->get();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(new Book);

        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'quantity' => 'required|integer|min:1',
            'shelf' => 'required',
            'description' => 'required',
            'cover' => 'required|image',
        ]);

        $data = $request->only('title', 'author', 'isbn', 'quantity', 'shelf', 'description');
        $book = new Book($data);

        $this->authorize($book);

        $cover = $request->file('cover');
        $filename = join('.', [str_random(32), $cover->guessExtension()]);

        if($cover->isValid()){
            $cover->move(storage_path('app/covers'), $filename);
        }

        $book->cover = "covers/$filename";

        $book->save();

        return redirect()->route('books.show', $book->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->authorize($book);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize($book);

        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'quantity' => 'required|integer|min:1',
            'shelf' => 'required',
            'description' => 'required',
            'cover' => 'sometimes|image',
        ]);

        $data = $request->only('title', 'author', 'isbn', 'quantity', 'shelf', 'description');

        if($request->hasFile('cover'))
        {
            $cover = $request->file('cover');
            $filename = join('.', [str_random(32), $cover->guessExtension()]);

            if($cover->isValid()){
                $cover->move(storage_path('app/covers'), $filename);
            }

            $data['cover'] = "covers/$filename";
        }

        $book->update($data);

        return redirect()
            ->route('books.show', $book->id)
            ->withFlashMessage('Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize($book);

        $book->delete();

        return redirect()->route('books.index');
    }
}