@extends('layouts.guest')
@section('content')
    <main class="container">
        <section class="promo">
            <h2 class="promo__title">Нужен стафф для катки?</h2>
            <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
            <ul class="promo__list">
                @foreach($categories as $category)
                    <li class="promo__item promo__item--{{$category->character_code}}">
                        <a class="promo__link" href="{{ route('guest', ['category' => $category->id]) }}">{{$category->title}}</a>
                    </li>
                @endforeach
            </ul>
        </section>
        <section class="lots">
            <div class="lots__header">
                <h2>Открытые лоты</h2>
            </div>
            <ul class="lots__list">
                @foreach($lots as $lot)
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="{{ asset('storage/' . $lot->image ) }}" width="350" height="260" alt="Сноуборд">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category">{{$lot->category->title}}</span>
                            <h3 class="lot__title"><a class="text-link" href="{{route('main.lot.view', $lot->id)}}">{{$lot->title}}</a></h3>
                            <div class="lot__state">
                                <div class="lot__rate">
                                    <span class="lot__amount">Стартовая цена</span>
                                    <span class="lot__cost">{{$lot->start_price}}<b class="rub">р</b></span>
                                </div>

                                @php
                                    $now = \Carbon\Carbon::now();
                                    $endTime = \Carbon\Carbon::parse($lot->date_finish);
                                    $diff = $endTime->diff($now);
                                @endphp
                                <div class="lot__timer timer @if ($diff->d < 1) lot__timer timer timer--finishing @endif">
                                    @if ($diff->d > 0)
                                        {{ $diff->d }} д {{ $diff->h }} ч {{ $diff->i }} мин
                                    @else
                                        {{ $diff->h }} ч {{ $diff->i }} мин
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div>
                {{ $lots->withQueryString()->links() }}
            </div>
        </section>
    </main>
@endsection
