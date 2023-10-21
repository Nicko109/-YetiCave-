{{--@extends('layouts.admin')--}}
{{--@section('content')--}}
{{--    <!-- Content Wrapper. Contains page content -->--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Content Header (Page header) -->--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1 class="m-0">Редактирование категории</h1>--}}
{{--                    </div><!-- /.col -->--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>--}}
{{--                            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Категории</a></li>--}}
{{--                            <li class="breadcrumb-item active">Редактирование категории</li>--}}
{{--                        </ol>--}}
{{--                    </div><!-- /.col -->--}}
{{--                </div><!-- /.row -->--}}
{{--            </div><!-- /.container-fluid -->--}}
{{--        </div>--}}
{{--        <!-- /.content-header -->--}}

{{--        <!-- Main content -->--}}
{{--        <section class="content">--}}
{{--            <div class="container-fluid">--}}
{{--                <!-- Small boxes (Stat box) -->--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <form class="w-25" action="{{ route('admin.category.actions', $category->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('PATCH')--}}
{{--                            <input type="hidden" name="action" value="update">--}}
{{--                            <input type="hidden" name="id" value="{{ $category->id }}" />--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="title">Название категории</label>--}}
{{--                                <input type="text" class="form-control" placeholder="Название категории" name="title"  value="{{ $category->title }}">--}}
{{--                                @error('title')--}}
{{--                                <div class="text-danger">Это поле необходимо для заполнения</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="character_code">Символьный код</label>--}}
{{--                                <input type="text" class="form-control" placeholder="Символьный код" name="character_code"  value="{{ $category->character_code }}">--}}
{{--                                @error('character_code')--}}
{{--                                <div class="text-danger">Это поле необходимо для заполнения</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <input type="submit" class="btn btn-primary" value="Изменить">--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.row -->--}}

{{--            </div><!-- /.container-fluid -->--}}
{{--        </section>--}}
{{--        <!-- /.content -->--}}
{{--    </div>--}}
{{--    <!-- /.content-wrapper -->--}}
{{--@endsection--}}
