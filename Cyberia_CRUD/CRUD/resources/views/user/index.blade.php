@extends('layouts/example')

@section('title') - Личный кабинет@endsection

@section('content')
    <h2 class="mb-4">Личный кабинет</h2>
    <h4 class="ms-5 mb-5"><a class="link-dark fw-bold
                                  underline-bold
                                  link-offset-1-hover
                                  link-underline-opacity-0
                                  link-underline-opacity-100-hover"
                             href="{{ route('authors_info', Auth::user()->author->id) }}">
            {{ Auth::user()->author->name }}
        </a>
    </h4>
    <div class="container mb-3">
        <div class="row">
            <div class="col-4">
                <h2 class="pt-3">Список ваших книг</h2></div>
            <div class="col-4"></div>
            <div class="col-4 d-flex justify-content-end">
                <span>
                <a class="btn btn-warning btn-sm fw-bold p-3 fs-6" href="{{ route('user-book.create') }}">Добавить книгу</a></span>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        @if(session('success'))
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-3">

                    </div>
                    <div class="col-6">
                        <div class="alert alert-success mt-3" role="alert">
                            <button type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">x</button>
                            <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                        </div>
                    </div>
                    <div class="col-3">

                    </div>
                </div>
            </div>
        @endif

        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-body pb-5 bg-secondary bg-gradient">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th class="ps-5" style="width: 28%">
                                Название книги
                            </th>
                            <th style="width: 24%">
                                Жанр(ы)
                            </th>
                            <th style="width: 24%">
                                Когда добавлена
                            </th>
                            <th style="width: 24%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( Auth::user()->author->books as $book)
                            <tr>
                                <th class="ps-5" style="width: 28%"><a class="link-dark fw-bold
                                                                       underline-bold
                                                                       link-offset-1-hover
                                                                       link-underline-opacity-0
                                                                       link-underline-opacity-100-hover"
                                                                href="{{ route('books_info', $book->id) }}">
                                    {{ $book->name_book }}
                                    </a>
                                </th>
                                <th style="width: 24%">
                                    @foreach($book->categories as $category)
                                        <a class="link-dark fw-bold
                                                  underline-bold
                                                  link-offset-1-hover
                                                  link-underline-opacity-0
                                                  link-underline-opacity-100-hover"
                                           href="{{ route('categories_info', $category->id) }}">
                                        {{ $category->name_category }}
                                        </a><br>
                                    @endforeach
                                </th>
                                <th style="width: 24%">
                                    {{ $book->created_at->format('d.m.Y') }}
                                </th>

                                <th class="project-actions text-right align-middle" style="width: 24%">
                                    <a class="btn btn-warning btn-sm fw-bold" href="{{ route('user-book.edit', $book->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('user-book.destroy', $book->id) }}"
                                          method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-dark btn-sm delete-btn fw-bold">
                                            <i class="fas fa-trash">
                                            </i>
                                            Удалить</button>
                                    </form>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
    </div>
@endsection
