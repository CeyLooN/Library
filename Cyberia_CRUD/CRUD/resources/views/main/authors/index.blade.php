@extends('layouts/example')

@section('title') - Авторы@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Список Авторов</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        @foreach($authors as $author)
            <a class="text-decoration-none" href="{{ route('authors_info', $author->id) }}">
                <div class="col-3">
                    <div class="alert alert-dark">
                        <p class="m-0 text-dark fw-bold">Имя автора: </p>
                        <h3 class="ps-4 mb-2">{{ $author->name }}</h3>
                        <p class="m-0 text-dark fw-bold">Книг написано: </p>
                        <h5 class="ps-4 mb-2">{{ $author->loadCount('books')->books_count }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{ $authors->links('pagination.main_paginate') }}

@endsection
