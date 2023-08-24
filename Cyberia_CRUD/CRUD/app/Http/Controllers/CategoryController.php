<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('main.categories.index', ['categories' => Category::paginate(1)]);
    }

    public function info($id)
    {
        $book = Category::find($id);
        return view('main.categories.info', ['category' => $book]);
    }
}
