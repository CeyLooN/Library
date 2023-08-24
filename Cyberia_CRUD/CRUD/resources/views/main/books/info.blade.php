@extends('layouts/example')

@section('title') - {{ $book->name_book }}@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Книга: {{ $book->name_book }}</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        <div class="container">
            <div class="alert alert-dark row align-items-start">
                <div class="col-3">
                    <h5 class="m-0 mb-2">Автор: </h5>
                    <p class="ps-4 m-0">
                        <a class="link-dark
                                  fw-bold
                                  underline-bold
                                  link-offset-1-hover
                                  link-underline-opacity-0
                                  link-underline-opacity-100-hover"
                           href="{{ route('authors_info', $book->author->id) }}">
                            {{ $book->author->name }}
                        </a>
                    </p>
                </div>
                <div class="col-3">
                    <h5 class="m-0 mb-2">Жанр(ы): </h5>
                    @foreach($book->categories as $category)
                        <p class="ps-4 m-0">
                            <a class="link-dark
                                      fw-bold
                                      underline-bold
                                      link-offset-1-hover
                                      link-underline-opacity-0
                                      link-underline-opacity-100-hover"
                               href="{{ route('categories_info', $category->id) }}">
                                {{ $category->name_category }}
                            </a>
                        </p>
                    @endforeach
                </div>
                <div class="col-3">
                    <h5 class="m-0 mb-2">Издание: </h5>
                    <p class="ps-4 m-0 text-dark fw-bold">{{ $book->edition }}</p>
                </div>
                <div class="col-3">
                    <h5 class="m-0 mb-2">Когда добавлена: </h5>
                    <p class="ps-4 m-0 text-dark fw-bold">{{ $book->created_at->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
