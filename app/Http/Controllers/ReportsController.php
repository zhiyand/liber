<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:librarian|administrator');
    }

    public function summary()
    {
        $books = Book::latest()->paginate(8);

        return view('reports.summary', [
            'books' => $books,
        ]);
    }
}
