@extends('layouts/example')

@section('title') - {{ $category->name_category }}@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Жанр: {{ $category->name_category }}</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        <div class="container">
            <div class="align-items-start row">
                <h5 class="m-0 mb-2">Список книг: </h5>
                @foreach($category->books as $book)
                    <div class="col-3">
                        <div class="alert alert-dark">
                                <p class="ps-4 m-0">
                                    Название книги:
                                    <a class="link-dark fw-bold
                                              underline-bold
                                              link-offset-1-hover
                                              link-underline-opacity-0
                                              link-underline-opacity-100-hover"
                                       href="{{ route('books_info', $book->id) }}">
                                        {{ $book->name_book }}
                                    </a>
                                </p>
                                <p class="ps-4 m-0">
                                    Имя Автора:
                                    <a class="link-dark fw-bold
                                              underline-bold
                                              link-offset-1-hover
                                              link-underline-opacity-0
                                              link-underline-opacity-100-hover"
                                       href="{{ route('authors_info', $book->author->id) }}">
                                        {{ $book->author->name }}
                                    </a>
                                </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
