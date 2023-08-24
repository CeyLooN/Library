@extends('layouts/admin')

@section('title', 'Список жанров')
@section('title_content')
    <h1 class="m-0">Список жанров</h1>
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
                                <th class="text-center" style="width: 10%">
                                    ID
                                </th>
                                <th style="width: 40%">
                                    Название жанра
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th class="text-center" style="width: 10%">
                                        {{ $category->id }}
                                    </th>
                                    <th style="width: 40%">
                                        {{ $category->name_category }}
                                    </th>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('category.edit', $category->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Редактировать
                                        </a>
                                        <form action="{{ route('category.destroy', $category->id) }}"
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
