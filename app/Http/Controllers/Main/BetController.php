<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BetController extends Controller
{

    public function index(Lot $lot)
    {
        $user = Auth::user();
        $categories = Category::all();
        $betQuery = Bet::query()->where('user_id', $user->id);
        $lots = Lot::all();
        $now = \Carbon\Carbon::now();


        $bets = $betQuery->orderBy('created_at', 'desc')->paginate(6);


        return view('main.bet.index', compact('user', 'categories', 'bets', 'lots', 'now'));
    }


    public function actions(Lot $lot, Request $request)
    {
        $bet = $request['id'] ? Bet::query()->findOrFail($request['id']) : new Bet();

        if ($request['action'] == 'create' || $request['action'] == 'update') {
            $data =$request->validate($this->rules($lot));
            $data['user_id'] = auth()->user()->id;
            $data['lot_id'] = $lot->id;
            $bet->fill($data);
            $bet->save($data);
        } elseif ($request['action'] == 'delete') {
            $bet->delete();
        }

        return redirect()->route('main.lot.view', $lot->id);
    }

    private function rules(Lot $lot)
    {
        // Получите минимальную ставку на основе последней ставки и шага лота
        $minBet = $this->getMinBet($lot);

        return [
            'price_bet' => 'required|integer|min:' . $minBet,
        ];
    }
    private function getMinBet(Lot $lot)
    {
        $lastBet = $lot->bets->sortByDesc('created_at')->first();
        return $lastBet ? $lastBet->price_bet + $lot->step : $lot->start_price + $lot->step;
    }

}
