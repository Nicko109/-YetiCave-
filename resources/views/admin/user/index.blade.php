@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Пользователи</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Пользователи</li>
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

{{--                <form class="search-form" action="{{ route('admin.user.index') }}" autocomplete="off" method="GET">--}}
{{--                    <input class="search-form__input" type="text" name="name" placeholder="Имя" value="{{ request()->get('name') }}">--}}
{{--                    <input class="search-form__input ml-3" type="text" name="email" placeholder="Email" value="{{ request()->get('email') }}">--}}

{{--                    <select name="role" class="search-form__select">--}}
{{--                        <option value="selected">Все роли</option>--}}
{{--                        @foreach($roles as $key => $role)--}}
{{--                            <option value="{{ $key }}" {{ (request('role') == $key) ? 'selected' : '' }}>{{ $role }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}

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
                                            Имя
                                            <a href="{{ route('admin.user.index', ['sort' => 'asc', 'column' => 'name']) }}">↑</a>
                                            <a href="{{ route('admin.user.index', ['sort' => 'desc', 'column' => 'name']) }}">↓</a>
                                        </th>
                                        <th>
                                            Email
                                            <a href="{{ route('admin.user.index', ['sort' => 'asc', 'column' => 'email']) }}">↑</a>
                                            <a href="{{ route('admin.user.index', ['sort' => 'desc', 'column' => 'email']) }}">↓</a>
                                        </th>
                                        <th colspan="3" class="text-center">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
{{--                                            <td class="text-center"> <a href="{{ route('admin.user.show', $user->id) }}"><i class="far fa-eye"></i></a></td>--}}
{{--                                            <td class="text-center"> <a href="{{ route('admin.user.edit', $user->id) }}" class="text-success"><i class="fas fa-edit"></i></a></td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="border-0 bg-transparent">--}}
{{--                                                        <i class="fas fa-trash text-danger"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div>
{{--                                    {{ $users->withQueryString()->links() }}--}}
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-2 mb-3">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-block btn-primary">Добавить</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
