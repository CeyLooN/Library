<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function index()
    {
        return view('main.authors.index', ['authors' => Author::paginate(1)]);
    }

    public function info($id)
    {
        return view('main.authors.info', ['author' => Author::find($id)]);
    }
}
