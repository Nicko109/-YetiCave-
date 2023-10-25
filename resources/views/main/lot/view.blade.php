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
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost">
                                    @if($lastBet)
                                    {{$lastBet->price_bet}}
                                    @else
                                        {{$lot->start_price}}
                                    @endif
                                </span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span>
                                    @if($lastBet)
                                        {{$lastBet->price_bet + $lot->step}} р
                                        @else
                                            {{$lot->start_price + $lot->step}} р
                                        @endif
                                </span>
                            </div>
                        </div>
                        @if (!$isOwner)
                            @if ($lastBet && $lastBet->user_id == $user->id)
                                <p>Вы сделали последнюю ставку и не можете делать ещё.</p>
                            @else
                                <form class="lot-item__form" action="{{route('main.lot.bet.actions', $lot->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="create">
                                    <p class="form__item @error('email') form__item--invalid @enderror">
                                        <label for="price_bet">Ваша ставка</label>
                                        <input id="price_bet" type="text" name="price_bet" placeholder="{{$lastBet ? $lastBet->price_bet + $lot->step : ($lot->start_price + $lot->step)}}" class="form__input @error('price_bet') form__error @enderror">
                                    </p>
                                    <button type="submit" class="button">Сделать ставку</button>
                                </form>
                            @endif
                        @elseif ($isOwner)
                            <p>Вы являетесь владельцем этого лота, поэтому не можете делать ставки.</p>
                        @endif
                        @if($errors->any())
                            <p class="error-message" style="color: red">Введите ставку не меньше мин. ставки</p>
                            @enderror

                    </div>
                    <div class="history">
                        <h3>История ставок ({{ $lot->bets->count()  }})</h3>
                        <table class="history__list">
                            @foreach($lot->bets()->orderBy('created_at', 'desc')->get() as $bet)
                            <tr class="history__item">
                                <td class="history__name">{{ $bet->user->name }}</td>
                                <td class="history__price">{{ $bet->price_bet }}</td>
                                <td class="history__time">{{ $bet->dateAsCarbon->diffForHumans() }}</td>
                            </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
        </section>
    </main>
@endsection
