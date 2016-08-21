<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Loan;
use App\Book;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $book = Book::find($request->book_id);

        if($book == null)
            abort(404);

        if($book->stock <= 0){
            return redirect()->back()->withErrors(['The book is out of stock.']);
        }

        if($user->books->contains($book)){
            return redirect()->back()->withErrors(['You already borrowed this book.']);
        }

        if($user->books->count() >= config('liber.loan_cap')){
            return redirect()->back()->withErrors(['You have reached your loan cap.']);
        }

        DB::transaction(function() use ($user, $book){
            $user->books()->attach($book, [
                'expiry' => Carbon::now()->addDays(config('liber.loan_period')),
            ]);

            $book->loaned += 1;
            $book->save();
        });

        return redirect()->back()->withFlashMessage('Book loan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
