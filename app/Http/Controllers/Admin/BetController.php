<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\FilterRequest;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BetController extends Controller
{

    public function index(Request $request)
    {
        $data = $request->all();

        $sort = $request->input('sort', 'asc');
        $priceSortLink = route('admin.bet.index', ['sort' => $sort === 'asc' ? 'desc' : 'asc']); // Добавьте ссылку для сортировки по цене

        $betQuery = Bet::query();

        if (isset($data['price_bet'])) {
            $betQuery->where('price_bet', '=', $data['price_bet']);
        }

        if (isset($data['lot_title'])) {
            $betQuery->whereHas('lot', function ($query) use ($data) {
                $query->where('title', 'like', '%' . $data['lot_title'] . '%');
            });
        }


        $betQuery->orderBy('price_bet', $sort);

        $bets = $betQuery->paginate(8);

        return view('admin.bet.index', compact('bets', 'priceSortLink', 'data'));
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
