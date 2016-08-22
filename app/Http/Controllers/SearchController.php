<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->q;

        $books = Book::where('title', 'like', "%$term%")
            ->orWhere('author', 'like', "%$term%")
            ->paginate();

        return view('books.index', compact('books', 'term'));
    }
}
