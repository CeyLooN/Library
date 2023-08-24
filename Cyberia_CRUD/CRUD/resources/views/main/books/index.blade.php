@extends('layouts/example')

@section('title') - Книги@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Список книг</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        @foreach($books as $book)
            <a class="text-decoration-none" href="{{ route('books_info', $book->id) }}">
                <div class="col-3">
                    <div class="alert alert-dark">
                        <p class="m-0 text-dark fw-bold">Название книги: </p>
                        <h3 class="ps-4 mb-2">{{ $book->name_book }}</h3>
                        <p class="m-0 text-dark fw-bold">Автор: </p>
                        <h5 class="ps-4 mb-2">{{ $book->author->name }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{ $books->links('pagination.main_paginate') }}

@endsection
