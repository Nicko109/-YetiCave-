@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (is_null($category))
                            <h1 class="m-0">Добавление категории</h1>
                        @else
                            <h1 class="m-0">Редактирование категории</h1>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Категории</a></li>
                            @if (is_null($category))
                                <li class="breadcrumb-item active">Добавление категории</li>
                            @else
                                <li class="breadcrumb-item active">Редактирование категории</li>
                            @endif
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
                <div class="row">
                    <div class="col-12">
                        <form class="w-25" action="{{ route('admin.category.actions') }}" method="POST">
                            @csrf
                            @if (is_null($category))
                                <input type="hidden" name="action" value="create">
                            @else
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="{{ $category->id }}">
                            @endif
                            <div class="form-group">
                                <label for="title">Название категории</label>
                                <input type="text" class="form-control" placeholder="Введите название категории" name="title" value="{{ is_null($category) ? '' : $category->title }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="character_code">Символьный код</label>
                                <input type="text" class="form-control" placeholder="Введите символьный код" name="character_code" value="{{ is_null($category) ? '' : $category->character_code }}">
                                @error('character_code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="{{ is_null($category) ? 'Добавить' : 'Изменить' }}">
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
