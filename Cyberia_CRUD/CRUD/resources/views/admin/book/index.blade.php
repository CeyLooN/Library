@extends('layouts/admin')

@section('title', 'Список книг')
@section('title_content')
    <div class="container align-items-start">
        <form  role="search"
              action="{{ route('book_search') }}" method="get">
            <div class="row">
                <div class="col">
                    <h2>Список книг</h2>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Выберите автора</label>
                        <select name="author_id" class="form-control">
                                <option value=""></option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}"
                                @if(isset($_GET['author_id'])){
                                    @if($_GET['author_id'] == $author->id){
                                    selected
                                    }@endif
                                }@endif>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Выберите жанр(ы)</label>
                        <select name="category_id" class="form-control">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                @if(isset($_GET['category_id'])){
                                    @if($_GET['category_id'] == $category->id){
                                    selected
                                    }@endif
                                }@endif>{{ $category->name_category}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>Название книги</label>
                        <input type="search"
                               class="form-control"
                               name="name_book"
                               placeholder="Поиск..."
                               aria-label="Search"
                        >
                        <button type="submit"
                                class="btn btn-secondary btn-sm m-1">
                            Найти</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="container">
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
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">
                                ID
                            </th>
                            <th style="width: 20%">
                                Название книги
                            </th>
                            <th style="width: 15%">
                                Жанр(ы)
                            </th>
                            <th style="width: 15%">
                                Автор
                            </th>
                            <th style="width: 15%">
                                Когда добавлена
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <th class="text-center" style="width: 5%">
                                    {{ $book->id }}
                                </th>
                                <th style="width: 20%">
                                    {{ $book->name_book }}
                                </th>
                                <th style="width: 15%">
                                    @foreach($book->categories as $category)
                                        {{ $category->name_category }}<br>
                                    @endforeach
                                </th>
                                <th style="width: 15%">
                                    {{ $book->author->name }}
                                </th>
                                <th style="width: 15%">
                                    {{ $book->created_at->format('d.m.Y') }}
                                </th>

                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm" href="{{ route('book.edit', $book->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Редактировать
                                    </a>
                                    <form action="{{ route('book.destroy', $book->id) }}"
                                          method="POST"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm delete-btn">
                                            <i class="fas fa-trash">
                                            </i>
                                            Удалить</button>
                                    </form>
                                </td>
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
