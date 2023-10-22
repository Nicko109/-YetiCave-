@extends('layouts.main')
@section('content')

    <main>
        <form class="form form--add-lot container form--invalid" action="{{ route('main.lot.actions') }}" method="POST"
              enctype="multipart/form-data"> <!-- form--invalid -->
            @csrf
            <input type="hidden" name="action" value="create">
            <h2>Добавление лота</h2>
            <div class="form__container-two">
                <div class="form__item @error('title') form__item--invalid @enderror">
                    <label for="title">Наименование <sup>*</sup></label>
                    <input id="title" type="text" name="title" placeholder="Введите наименование лота">
                    @error('title')
                    <span class="form__error" role="alert">
                                        <strong>Введите наименование лота</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="category_id">Категория <sup>*</sup></label>
                    <select id="category_id" name="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == old('category_id') ? 'selected' : ''}}>{{ $category->title }}</option>

                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="form__error" role="alert">
                                        <strong>Выберите категорию</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form__item form__item--wide">
                <label for="lot_description">Описание <sup>*</sup></label>
                <textarea id="lot_description" name="lot_description" placeholder="Напишите описание лота"></textarea>
                @error('lot_description')
                <span class="form__error" role="alert">
                                        <strong>Напишите описание лота</strong>
                                    </span>
                @enderror
            </div>
            <div class="form__item form__item--file">
                <label>Изображение <sup>*</sup></label>
                <div class="form__input-file">
                    <input class="visually-hidden" type="file" id="image" value="" name="image">
                    <label for="image">
                        Добавить
                    </label>
                </div>
            </div>
            <div class="form__container-three">
                <div class="form__item form__item--small">
                    <label for="start_price">Начальная цена <sup>*</sup></label>
                    <input id="start_price" type="text" name="start_price" placeholder="0">
                    @error('start_price')
                    <span class="form__error" role="alert">
                                        <strong>Введите начальную цену</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form__item form__item--small">
                    <label for="step">Шаг ставки <sup>*</sup></label>
                    <input id="step" type="text" name="step" placeholder="0">
                    @error('start_price')
                    <span class="form__error" role="alert">
                                        <strong>Введите шаг ставки</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form__item">
                    <label for="date_finish">Дата окончания торгов <sup>*</sup></label>
                    <input class="form__input-date" id="date_finish" type="datetime-local" name="date_finish"
                           placeholder="">
                    @error('start_price')
                    <span class="form__error" role="alert">
                                        <strong>Введите дату завершения торгов</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form__row form__row--controls">
                @if($errors->any())
                    <p class="form__error form__error--bottom" style="color: red">Пожалуйста, исправьте ошибки в форме</p>
                @endif
            </div>
            <button type="submit" class="button">Добавить лот</button>

        </form>
    </main>

@endsection
