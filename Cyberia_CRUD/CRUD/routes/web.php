<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('main');
})->name('main');

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');

    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);

    Route::get('book/search', \App\Http\Controllers\Admin\BookController::class.'@search')->name('book_search');
    Route::resource('book', \App\Http\Controllers\Admin\BookController::class);

    Route::resource('author', \App\Http\Controllers\Admin\AuthorController::class);

    Route::resource('book_category', \App\Http\Controllers\BookCategoryController::class);
});

Route::middleware(['role:user'])->prefix('user')->group(function () {
    Route::get('/cabinet', [App\Http\Controllers\User\CabinetController::class, 'index'])->name('cabinet');
    Route::resource('user-book', App\Http\Controllers\User\BookController::class)->parameters([
        'user-book' => 'book'
    ]);
});

/*Route::group([
    'as' => 'user.',
    'prefix' => 'user',
    'namespace' => 'User',
    'midleware' => ['auth']
], function (){
    Route::get('cabinet', \App\Http\Controllers\User\CabinetController::class)->name('cabinet');

    Route::resource('book', 'BookController');
});*/

Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors');
Route::get('/authors/info/a_i={id}', [App\Http\Controllers\AuthorController::class, 'info'])->name('authors_info');

Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books');
Route::get('/books/info/b_i={id}', [App\Http\Controllers\BookController::class, 'info'])->name('books_info');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/info/a_i={id}', [App\Http\Controllers\CategoryController::class, 'info'])->name('categories_info');
