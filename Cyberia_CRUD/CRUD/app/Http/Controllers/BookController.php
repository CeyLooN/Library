<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller {

    public function submit(Request $req) {
        $book = new Book();
        $book->book_name = $req->input('book_name');
        $book->text = $req->input('text');

        $book->save();

        return redirect()->route('books');
    }

    public function index()
    {
        return view('main.books.index', ['books' => Book::orderBy('name_book', 'asc')->paginate(1)]);
    }

    public function info($id)
    {
        $book = Book::find($id);
        return view('main.books.info', ['book' => $book]);
    }
}
