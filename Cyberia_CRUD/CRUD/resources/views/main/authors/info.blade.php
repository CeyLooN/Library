@extends('layouts/example')

@section('title') - {{ $author->name }}@endsection

@section('content')
    <div class="row align-items-start pb-5">
        <div class="col">
            <h2>Автор: {{ $author->name }}</h2>
        </div>
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="row align-items-start pb-5">
        <div class="container">
            <div class="alert alert-dark col-4 align-items-start">
                <h5 class="m-0 mb-2">Написанные книги: </h5>
                @foreach($author->books as $book)
                    <p class="ps-4 m-0">
                        <a class="link-dark fw-bold
                                  underline-bold
                                  link-offset-1-hover
                                  link-underline-opacity-0
                                  link-underline-opacity-100-hover"
                           href="{{ route('books_info', $book->id) }}">
                            {{ $book->name_book }}
                        </a>
                    </p>
                @endforeach
            </div>
        </div>
    </div>

@endsection
