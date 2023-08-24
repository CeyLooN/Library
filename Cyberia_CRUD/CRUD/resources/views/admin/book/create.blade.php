@extends('layouts/admin')

@section('title', 'Создать книгу')
@section('title_content')
    <h1 class="m-0">Созздать книгу</h1>
@endsection

@section('content')
    <div class="card card-success container p-0">
        <div class="card-header">
            <h3 class="card-title">Создание</h3>
        </div>
        @if(session('success'))
            <div class="row align-items-start">
                <div class="col-3">

                </div>
                <div class="col-6">
                    <div class="alert alert-success mt-3" role="alert">
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        @elseif(session('not_success'))
            <div class="row align-items-start">
                <div class="col-3">

                </div>
                <div class="col-6">
                    <div class="alert alert-danger mt-3" role="alert">
                        <h4><i class="icon fa fa-check"></i>{{ session('not_success') }}</h4>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('book.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название книги</label>
                    <input type="text"
                           name="name_book"
                           class="form-control"
                           id="name_book"
                           placeholder="Введите название"
                           required
                    >
                </div>
                <div class="form-group">
                    <label>Выберите автора</label>
                    <select name="author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Выберите издание</label>
                    <select name="edition" class="form-control" required>
                        @foreach($enum as $edition)
                            <option value="{{ $edition }}">{{ $edition }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Выберите жанр(ы)</label>
                    <select name="categories[]" multiple="" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Создать</button>
            </div>
        </form>
    </div>
@endsection
