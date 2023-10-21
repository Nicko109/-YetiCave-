    @extends('layouts.admin')
    @section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Категории</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                                <li class="breadcrumb-item active">Категории</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

    {{--                <form class="search-form" action="{{ route('admin.category.index') }}" autocomplete="off" method="GET">--}}
    {{--                    <input class="search-form__input" type="text" name="title" placeholder="Название проекта" value="{{ request()->get('title') }}">--}}
    {{--                    <input class="btn-primary mb-4" type="submit" value="Поиск">--}}
    {{--                </form>--}}
                    <div class="row">
                        <div class="col-6">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>
                                                Название
                                                <a href="{{ route('admin.category.index', ['sort' => 'asc'])}}">↑</a>
                                                <a href="{{ route('admin.category.index', ['sort' => 'desc'])}}">↓</a>
                                            </th>
                                            <th>Символьный код</th>
                                            <th colspan="3" class="text-center">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->character_code }}</td>
                                                <td class="text-center"> <a href="{{ route('admin.category.view', $category->id) }}"><i class="far fa-eye"></i></a></td>
                                                <td class="text-center"> <a href="{{ route('admin.category.form', $category->id) }}" class="text-success"><i class="fas fa-edit"></i></a></td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.category.actions', $category->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="{{ $category->id }}" />
                                                        <button type="submit" class="border-0 bg-transparent">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
    {{--                                <div>--}}
    {{--                                    {{ $categories->withQueryString()->links() }}--}}
    {{--                                </div>--}}
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-2 mb-3">
                            <a href="{{ route('admin.category.form') }}" class="btn btn-block btn-primary">Добавить</a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
    @endsection
