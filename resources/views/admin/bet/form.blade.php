
@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if (is_null($bet))
                            <h1 class="m-0">Добавление ставки</h1>
                        @else
                            <h1 class="m-0">Редактирование ставки</h1>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.bet.index') }}">Категории</a></li>
                            @if (is_null($bet))
                                <li class="breadcrumb-item active">Добавление ставки</li>
                            @else
                                <li class="breadcrumb-item active">Редактирование ставки</li>
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
                        <form class="w-25" action="{{ route('admin.bet.actions') }}" method="POST">
                            @csrf
                            @if (is_null($bet))
                                <input type="hidden" name="action" value="create">
                            @else
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="{{ $bet->id }}">
                            @endif
                            <div class="form-group">
                                <label for="title">Сумма ставки</label>
                                <input type="text" class="form-control" placeholder="Введите сумму ставки" name="price_bet" value="{{ is_null($bet) ? '' : $bet->title }}">
                                @error('price_bet')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label>Лот</label>
                                <select name="lot_id" class="form-control">
                                    @foreach($lots as $lot)
                                        <option value="{{ $lot->id }}"
                                        @if(is_null($lot))
                                            {{ $lot->id == old('lot_id') ? 'selected' : ''}}
                                            @else
                                            {{ $lot->id == $lot->lot_id ? 'selected' : ''}}
                                            @endif
                                        >{{ $lot->title }}</option>
                                    @endforeach
                                </select>
                                @error('lot_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="{{ is_null($bet) ? 'Добавить' : 'Изменить' }}">
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

