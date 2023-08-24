<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\BookCategory;
use App\Enums\BookEditionEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $books = Book::orderBy('name_book')->get();

        return view('admin.book.index', ['books' => $books,
                                               'authors' => Author::all(),
                                               'categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::orderBy('name_category')->get();
        $authors = Author::orderBy('name')->get();

        return view('admin.book.create', ['categories' => $categories,
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
            $new_book->author_id = $request->author_id;
            $new_book->edition = $request->edition;
            $author = $new_book->author;
            $author->books()->save($new_book);
            $new_book->categories()->attach($request->categories);
            $new_book->save();
            Log::channel('books')->info('CREATE BOOK', ['Book ID' => $new_book->id,
                                                        'Book name' => $new_book->name_book,
                                                        'Author' => $new_book->author->name,
                                                        'Book edition' => $new_book->edition,
                                                        'Book categories' => $new_book->categories,
                                                        'User create ID' => Auth::user()->id]);
            return redirect()->back()->with('success','Книга была добавлена.');
        }
    }


    public function search(Request $request) {

        if ($request->name_book) $query = $request->name_book;
        else $query = '';
        if ($request->category_id <> '') $cat_books = Category::find ($request->category_id)->books()->get();
        else $cat_books = Book::all();
        if ($request->author_id <> '') $auth_books = Author::find ($request->author_id)->books()->get();
        else $auth_books = Book::all();

        $books_id = $cat_books->pluck("id")->intersect($auth_books->pluck("id"));
        $books = Book::where('name_book', 'LIKE', '%'.$query.'%')->get();
        $books = $books->find($books_id);

        return view('admin.book.index', ['books' => $books,
                                               'authors' => Author::all(),
                                               'categories' => Category::all()]);
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
    public function edit(Book $book) {

        $categories = Category::orderBy('name_category')->get();
        $authors = Author::orderBy('name')->get();

        return view('admin.book.edit', ['book' => $book,
                                              'categories' => $categories,
                                              'authors' => $authors]);
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
        $book->author()->disassociate();
        $old_name = $book->name_book;
        $book->name_book = $request->name_book;
        $old_author = $book->author_id;
        $book->author_id = $request->author_id;
        $author = Author::find($request->author_id);
        $author->books()->save($book);
        $old_edition = $book->edition;
        $book->edition = $request->edition;
        $old_categories = $book->categories;
        $book->categories()->detach();
        $book->categories()->attach($request->categories);
        Log::channel('books')->info('REFACTOR BOOK', ['Book ID' => $book->id,
                                                    'Old book name' => $old_name,
                                                    'Book name' => $book->name_book,
                                                    'Old Author' => $old_author,
                                                    'Author' => $book->author->name,
                                                    'Old book edition' => $book->edition,
                                                    'Book edition' => $book->edition,
                                                    'Old book categories' => $old_categories,
                                                    'Book categories' => $book->categories,
                                                    'User create ID' => Auth::user()->id]);

        return redirect()->back()->with('success','Книга была обнавлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book) {

        $book->categories()->detach();
        $book->delete();

        return redirect()->back()->with('success','Книга была удалена.');
    }
}
