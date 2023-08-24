<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Enums\BookEditionEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::orderBy('name_category')->get();
        $authors = Author::orderBy('name')->get();

        return view('user.book.create', ['categories' => $categories,
                                                'authors' => $authors,
                                                'enum' => BookEditionEnum::cases()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $books = Book::all();

        if ($books->where('name_book', $request->name_book)->all())
        {
            return redirect()->back()->with(
                'not_success','Книга с таким названием ('.$request->name_book.') уже существует.'
            );
        }
        else
        {
            $new_book = new Book();
            $new_book->name_book = $request->name_book;
            $new_book->author_id = Auth::user()->author->id;
            $new_book->edition = $request->edition;
            $author = $new_book->author;
            $author->books()->save($new_book);
            $new_book->categories()->attach($request->categories);
            $new_book->save();
            return redirect()->back()->with('success','Книга была добавлена.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if (Auth::user()->author->id === $book->author->id) {
            $categories = Category::orderBy('name_category')->get();

            return view('user.book.edit', ['book' => $book,
                'categories' => $categories]);
        }
        else abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $books = Book::all();
        if ($books->where('name_book', $book->name_book)->all())
        {
            return redirect()->back()->with(
                'not_success','Книга с таким названием ('.$book->name_book.') уже существует.'
            );
        }
        $book->name_book = $request->name_book;
        $book->categories()->detach();
        $book->categories()->attach($request->categories);
        $book->save();

        return redirect()->back()->with('success','Книга была обнавлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->categories()->detach();
        $book->delete();

        return redirect()->back()->with('success','Книга была удалена.');
    }
}
