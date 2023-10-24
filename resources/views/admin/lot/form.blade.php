@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if(is_null($lot))
                            <h1 class="m-0">Добавление лота</h1>
                        @else
                            <h1 class="m-0">Редактирование лота</h1>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lot.index') }}">Лоты</a></li>
                            @if(is_null($lot))
                                <li class="breadcrumb-item active">Добавление лота</li>
                            @else
                                <li class="breadcrumb-item active">Редактирование лота</li>
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
                    <form class="w-50" action="{{ route('admin.lot.actions') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @if (is_null($lot))
                            <input type="hidden" name="action" value="create">
                        @else
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{ $lot->id }}">
                        @endif
                        <div class="form-group w-50">
                            <label for="name">Наименование</label>
                            <input type="text" class="form-control" placeholder="Название лота" name="title"
                                   value="{{ is_null($lot) ? '' : $lot->title }}">
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label>Категория</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                    @if(is_null($lot))
                                        {{ $category->id == old('category_id') ? 'selected' : ''}}
                                            @else
                                        {{ $category->id == $lot->category_id ? 'selected' : ''}}
                                            @endif
                                    >{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contacts">Описание</label>
                            <textarea class="form-control" name="lot_description" id="lot_description"
                                      placeholder="Напишите описание лота">{{ is_null($lot) ? '' : $lot->lot_description }}</textarea>
                            @error('lot_description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Изображение</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                           name="image" {{ is_null($lot) ? '' : $lot->image }}>
                                    <label class="custom-file-label">Добавить</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузка</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-50">
                            <label for="name">Начальная цена</label>
                            <input type="number" class="form-control" placeholder="0" name="start_price"
                                   value="{{ is_null($lot) ? '' : $lot->start_price }}">
                            @error('start_price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="name">Шаг ставки</label>
                            <input type="number" class="form-control" placeholder="0" name="step"
                                   value="{{ is_null($lot) ? '' : $lot->step }}">
                            @error('step')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="name">Дата окончания торгов</label>
                            <div class="input-group">
                                <input type="datetime-local" class="form-control" name="date_finish"
                                       value="{{ is_null($lot) ? '' : $lot->date_finish }}">
                            </div>
                            @error('date_finish')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="submit" class="btn btn-primary"
                               value="{{ is_null($lot) ? 'Добавить лот' : 'Изменить' }}">
                    </form>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
