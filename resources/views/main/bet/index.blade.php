@extends('layouts.main')
@section('content')
        <section class="rates container">
            <h2>Мои ставки</h2>
            <table class="rates__list">
                @foreach($bets as $bet)
                <tr class="rates__item">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="{{ asset('storage/' . $bet->lot->image ) }}" height="40" alt="Сноуборд">
                        </div>
                        <h3 class="rates__title"><a href="{{route('main.lot.view', $bet->lot->id)}}">{{ $bet->lot->title }}</a></h3>
                    </td>
                    <td class="rates__category">
                        {{ $bet->lot->category->title }}
                    </td>

                    <td class="rates__timer">
                        <div>
                            @php
                                $now = \Carbon\Carbon::now();
                                $endTime = \Carbon\Carbon::parse($bet->lot->date_finish);
                                $diff = $endTime->diff($now);
                            @endphp
                            <div class="lot__timer timer @if ($diff->d < 1) lot__timer timer timer--finishing @endif">
                                @if ($diff->d > 0)
                                    {{ $diff->d }} д {{ $diff->h }} ч {{ $diff->i }} мин
                                @else
                                    {{ $diff->h }} ч {{ $diff->i }} мин
                                @endif

                        </div>
                    </td>
                    <td class="rates__price">
                        {{ $bet->price_bet }}
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
