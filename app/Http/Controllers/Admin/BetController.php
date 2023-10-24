<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BetController extends Controller
{

    public function index()
    {
        $lots = Lot::all();

        $betQuery = Bet::query();

        $bets = $betQuery->paginate(8);

        return view('admin.bet.index', compact('bets', 'lots'));
    }



    public function view($betId)
    {
        $bet = Bet::find($betId);

        return view('admin.bet.view', compact('bet'));
    }


    public function form($betId = '')
    {
        $lots = Lot::all();
        $bet = null;
        if (!empty($betId)) {
            $bet = Bet::query()->where('id', $betId)->first();
        }

            return view('admin.bet.form', compact('lots','bet' ));

    }

    public function actions(Request $request)
    {
        $bet = $request['id'] ? Bet::query()->findOrFail($request['id']) : new Bet();

        if ($request['action'] == 'create' || $request['action'] == 'update') {
            $data =$request->validate($this->rules());
            $data['user_id'] = auth()->user()->id;
            $bet->fill($data);
            $bet->save($data);
        } elseif ($request['action'] == 'delete') {
            $bet->delete();
        }


        return redirect()->route('admin.bet.index');
    }

    private function rules()
    {
        $rules = [
            'price_bet' => 'required|integer|min:1',
            'lot_id' => 'required|integer|exists:lots,id',
        ];
        return $rules;
    }

}
