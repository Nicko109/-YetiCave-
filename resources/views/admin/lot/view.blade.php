@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0">{{ $lot->title }}</h1>

                        <a href="{{ route('admin.lot.form', $lot->id) }}" class="text-success"><i class="fas fa-edit ml-3"></i></a>

                            <td class="text-center">
                            <form action="{{ route('admin.lot.actions', $lot->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="{{ $lot->id }}" />
                                <button type="submit" class="border-0 bg-transparent">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.lot.index') }}">Лот</a></li>
                            <li class="breadcrumb-item active">{{ $lot->title }}</li>
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
                    <div class="col-6">
                        <div class="col-12">
                            <div class="card">

                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Наименование</th>
                                            <th>Начальная цена</th>
                                            <th>Шаг ставки</th>
                                            <th>Дата завершения</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td>{{ $lot->id }}</td>
                                            <td>{{ $lot->title }}</td>
                                            <td>{{ $lot->start_price }}</td>
                                            <td>{{ $lot->step }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lot->date_finish)->format('d.m.Y') }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>


                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
