@extends('layouts.main')
@section('content')
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">
            @if($bets->count() <= 0)
                <main class="content__main">
                    <div class="w-50">
                        <h2 class="rates__title">У Вас пока нет ставок</h2>
                    </div>
                </main>
            @endif
            @foreach($bets as $bet)
                @php
                    $lastBet = $bet->lot->bets->sortByDesc('created_at')->first();
                       $endTime = \Carbon\Carbon::parse($bet->lot->date_finish);
                       $diff = $endTime->diff($now);
                @endphp
                <tr class="rates__item
                @if($diff->invert === 0) rates__item--end @endif
                    @if($diff->invert === 0 && $lastBet->user_id == $user->id) rates__item rates__item--win @endif               ">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="{{ asset('storage/' . $bet->lot->image ) }}" height="40" alt="Сноуборд">
                        </div>
                        <div>
                        <h3 class="rates__title"><a
                                    href="{{route('main.lot.view', $bet->lot->id)}}">{{ $bet->lot->title }}</a></h3>
                        @if($diff->invert === 0 && $lastBet->user_id == $user->id)
                        <p>Контакты владельца лота: {{ $bet->lot->user->contacts }}</p>
                        @endif
                        </div>
                    </td>
                    <td class="rates__category">
                        {{ $bet->lot->category->title }}
                    </td>

                    <td class="rates__timer">
                        <div>
                            @if($diff->invert !== 0)
                                <div class="lot__timer timer @if ($diff->d < 1)timer timer--finishing @endif">
                                    @if ($diff->d > 0)
                                        {{ $diff->d }} д {{ $diff->h }} ч {{ $diff->i }} мин
                                    @else
                                        {{ $diff->h }} ч {{ $diff->i }} мин
                                    @endif
                                </div>
                            @elseif($diff->invert === 0 && $lastBet->user_id == $user->id)
                                    <div class="timer timer--win">Ставка выиграла</div>
                        @else
                                    <div class="timer timer--end">Торги окончены</div>
                        @endif
                    </td>
                    <td class="rates__price">
                        {{ $bet->price_bet }} р
                    </td>
                    <td class="rates__time">
                        {{ $bet->dateAsCarbon->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
        </table>
        <div>
            {{ $bets->withQueryString()->links() }}
        </div>
    </section>
@endsection
