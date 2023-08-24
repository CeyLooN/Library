@extends('layouts/admin')

@section('title', 'Жанр')
@section('title_content')
    <h1 class="m-0">Редактирование жанра</h1>
@endsection

@section('content')
    <div class="card card-yellow container p-0">
        <div class="card-header">
            <h3 class="card-title">Редактирование жанра: {{ $category->name_category }}</h3>
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
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1" >Название жанра</label>
                    <input type="text"
                           name="name_category"
                           class="form-control"
                           value="{{ $category->name_category }}"
                           id="name_category"
                           placeholder="Введите название"
                           required
                    >
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Обновить</button>
            </div>
        </form>
    </div>
@endsection
