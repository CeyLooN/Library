<?php

namespace App\Http\Controllers\Api_1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Auth::guard('api')->user()->author->id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with('author')->with('categories')->findOrFail($id);
        $auth_id =auth('api')->user()->author->id;
        $b_auth_id = $book->author_id;
        if ($b_auth_id === $auth_id){
            return new BookResource($book);
        }
        else return ['error' => ['book_author_id' => $b_auth_id,
                                 'user_author_id' => $auth_id]];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Book::all();
        $book = Book::find($id);
        if ($books->where('name_book', $request->name_book)->all())
        {
            return ['error' => ['this name_book is taken']];
        }
        $old_name = $book->name_book;
        $book->name_book = $request->name_book;
        $old_edition = $book->edition;
        $book->edition = $request->edition;
        $old_categories = CategoryResource::collection($book->categories);
        $book->categories()->detach();
        $categories_id = explode(',', $request->categories);
        foreach ($categories_id as $category) $book->categories()->attach((int)$category);
        $book->save();
        $new_book = Book::find($id);
        $new_categories = CategoryResource::collection($new_book->categories);
        Log::channel('books')->info('REFACTOR BOOK (API|AUTHOR)', ['Book ID' => $book->id,
                                                                   'Old book name' => $old_name,
                                                                   'Book name' => $book->name_book,
                                                                   'Author ID' => $book->author->name,
                                                                   'Old book edition' => $old_edition,
                                                                   'Book edition' => $book->edition,
                                                                   'Old book categories' => $old_categories,
                                                                   'Book categories' => $new_categories,
                                                                   'User create ID' => Auth::user()->id]);

        return new BookResource(Book::with('author')->with('categories')->findOrFail($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $auth_id =auth('api')->user()->author->id;
        $b_auth_id = $book->author_id;
        $book_id = $book->id;
        if ($b_auth_id === $auth_id){
            $book->categories()->detach();
            $book->delete();
            Log::channel('books')->info('DELETE BOOK (API|AUTHOR)', ['Book ID' => $book_id,
                                                                     'Author ID' => $auth_id]);
            return response(null, Response::HTTP_NO_CONTENT);
        }
        else return ['error' => ['book_author_id' => $b_auth_id,
            'user_author_id' => $auth_id]];
    }
}
