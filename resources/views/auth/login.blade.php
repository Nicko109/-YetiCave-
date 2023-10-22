@extends('layouts.main')

@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="content">
                <main class="content__main">
                    <form class="form container" method="POST" action="{{ route('login') }}" autocomplete="off">
                        <h2 class="content__main-heading">Вход</h2>
                        @csrf
                        <div class="form__item @error('email') form__item--invalid @enderror">
                            <label for="email">E-mail <sup>*</sup></label>
                            <input id="email" type="text" class="form__input @error('email') form__error @enderror"
                                   name="email" placeholder="Введите e-mail">
                            @error('email')
                            <span class="form__error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form__item @error('email') form__item--invalid @enderror">
                            <label for="password">Пароль <sup>*</sup></label>

                            <input id="password" type="password" class="form__input @error('email') form__error @enderror"
                                   name="password" placeholder="Введите пароль">
                            @error('password')
                            <span class="form__error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form__row form__row--controls">
                            @if($errors->any())
                                <p class="error-message" style="color: red">Пожалуйста, исправьте ошибки в форме</p>
                            @endif
                            <input class="button" type="submit" name="" value="Войти">
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </div>
@endsection
