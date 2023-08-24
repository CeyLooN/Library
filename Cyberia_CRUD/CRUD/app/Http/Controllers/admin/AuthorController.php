<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $authors = Author::all();

        return view('admin.author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {

        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $author = new Author();
        $author->name = $request['name'];
        $author->user_id = $user->id;
        $author->save();
        $user->assignRole('user');

        return redirect()->back()->with('success','Автор был добавлен.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author) {

        return view('admin.author.edit', ['author' => $author]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author) {

        $author->name = $request->name;
        $author->save();
        $user = $author->user;
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success','Имя автора обновлено.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author) {

        $author->user->delete();
        $author->delete();

        return redirect()->back()->with('success','Автор был удален.');
    }
}
