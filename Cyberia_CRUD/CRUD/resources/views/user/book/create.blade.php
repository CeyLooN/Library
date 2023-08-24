@extends('layouts/example')

@section('title') - Создание книги@endsection

@section('content')
    <div class="card card-success container p-0">
        <div class="card-header">
            <h3 class="card-title">Создание книги</h3>
        </div>
        @if(session('success'))
            <div class="row align-items-start">
                <div class="col-3">

                </div>
                <div class="col-6">
                    <div class="alert alert-success mt-3" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('not_success') }}</h4>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('user-book.store') }}" method="POST">
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
                <button type="submit" class="btn btn-warning">Создать</button>
            </div>
        </form>
    </div>
@endsection
