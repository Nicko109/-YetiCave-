@extends('layouts.main')
@section('content')
    <main>
        <section class="lot-item container">
            <h2>{{ $lot->title }}</h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src="{{ asset('storage/' . $lot->image ) }}" width="730" height="548" alt="Сноуборд">
                    </div>
                    <p class="lot-item__category">Категория: <span>{{$lot->category->title}}</span></p>
                    <p class="lot-item__description">{{ $lot->lot_description }}</p>
                </div>
                <div class="lot-item__right">
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            {{$lot->date_finish}}
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost">{{$lot->start_price}}</span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span>{{$lot->start_price + 1}} р</span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                            <p class="lot-item__form-item form__item @error('email') form__item--invalid @enderror">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="text" name="cost" placeholder="{{$lot->start_price + 1}}">
                                <span class="@error('email') form__error @enderror">Введите наименование лота</span>
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                    <div class="history">
                        <h3>История ставок (<span>0</span>)</h3>
                        <table class="history__list">
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
