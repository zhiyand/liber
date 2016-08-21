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
        parent::__construct();

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

        if($user->loans->count() >= $user->loanCap){
            return redirect()->back()->withErrors(['You have reached your loan cap.']);
        }

        $loan = new Loan([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'expiry' => Carbon::now()->addDays(config('liber.loan_period')),
            'status' => 'active',
        ]);

        DB::transaction(function() use ($loan, $book){
            $loan->save();

            $book->loaned += 1;
            $book->save();
        });

        if( ! $loan->id ){
            return redirect()
                ->back()
                ->withErrors(['Unknown error. Please contact admin.']);
        }

        return redirect()
            ->route('loans.show', $loan->id)
            ->withFlashMessage('Book loan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('loans.show', [
            'loan' => $loan,
            'book' => $loan->book,
        ]);
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
    public function destroy(Loan $loan, Request $request)
    {
        $this->authorize($loan);

        DB::transaction(function() use ($loan){
            $loan->book->loaned -= 1;
            $loan->book->save();

            $loan->close();
        });

        return redirect()->back()->withFlashMessage('Book returned successfully.');
    }
}
