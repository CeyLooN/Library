@extends('layouts/example')

@section('title') - Жанры@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Список Жанров</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        @foreach($categories as $category)
            <a class="text-decoration-none" href="{{ route('categories_info', $category->id) }}">
                <div class="col-3">
                    <div class="alert alert-dark">
                        <p class="m-0 text-dark fw-bold">Название жанра: </p>
                        <h3 class="ps-4 mb-2">{{ $category->name_category }}</h3>
                        <p class="m-0 text-dark fw-bold">Книг этого жанра </p>
                        <h5 class="ps-4 mb-2">{{ $category->loadCount('books')->books_count }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{ $categories->links('pagination.main_paginate') }}

@endsection
