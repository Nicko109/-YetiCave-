@extends('layouts.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        @if(is_null($user))
                            <h1 class="m-0">Добавление пользователя</h1>
                        @else
                            <h1 class="m-0">Редактирование пользователя</h1>
                        @endif
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Пользователи</a></li>
                            @if(is_null($user))
                                <li class="breadcrumb-item active">Добавление пользователя</li>
                            @else
                                <li class="breadcrumb-item active">Редактирование пользователя</li>
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
                    <form class="w-50" action="{{ route('admin.user.actions') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @if (is_null($user))
                            <input type="hidden" name="action" value="create">
                        @else
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                        @endif
                        <div class="form-group w-50">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Email" name="email"
                                   value="{{ is_null($user) ? '' : $user->email }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" placeholder="Пароль" name="password"
                                   value="{{ is_null($user) ? '' : $user->password }}">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" placeholder="Имя пользователя" name="name"
                                   value="{{ is_null($user) ? '' : $user->name }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contacts">Контактные данные</label>
                            <textarea class="form-control" name="contacts" id="contacts"
                                      placeholder="Напишите как с Вами связаться">{{ is_null($user) ? '' : $user->contacts }}</textarea>
                            @error('contacts')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Аватар</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                           name="avatar" {{ is_null($user) ? '' : $user->avatar }}>
                                    <label class="custom-file-label">Добавить</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузка</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group w-25">
                            <label>Выберите роль</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}"
                                    @if(is_null($user))
                                        {{ $id == old('role') ? ' selected' : '' }}
                                        @else
                                        {{ $id == $user->role ? ' selected' : '' }}
                                        @endif
                                    >{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-primary"
                               value="{{ is_null($user) ? 'Добавить' : 'Изменить' }}">
                    </form>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
