@extends('layouts/example')

@section('title') - Редактирование книги@endsection

@section('content')
    <div class="card card-info container p-0">
        <div class="card-header">
            <h3 class="card-title">Редактирование {{ $book->name_book }}</h3>
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
        <form action="{{route('user-book.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название книги</label>
                    <input type="text"
                           value="{{ $book->name_book }}"
                           name="name_book"
                           class="form-control"
                           id="name_book"
                           placeholder="Введите название"
                           required
                    >
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
                <button type="submit" class="btn btn-warning">Обновить</button>
            </div>
        </form>
    </div>
@endsection
