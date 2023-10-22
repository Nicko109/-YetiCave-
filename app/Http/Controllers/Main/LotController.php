<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LotController extends Controller
{


    public function view($lotId)
    {
        $user = Auth::user();
        $lot = Lot::find($lotId);
        return view('main.lot.view', compact('lot', 'user'));
    }

    public function form($lotId = '')
    {

        $categories = Category::all();
        $lot = null;

        if (!empty($lotId)) {
            $lot = Lot::query()->where('id', $lotId)->first();
        }

        return view('main.lot.form', compact( 'categories','lot'));
    }

    public function actions(Request $request)
    {
        $lot = $request['id'] ? Lot::query()->findOrFail($request['id']) : new Lot();


        if($request['action'] == 'create' || $request['action'] == 'update') {
            $data = $request->validate($this->rules());
            $data['image'] = Storage::put('/images', $data['image']);
            $data['user_id'] = auth()->user()->id;
            $lot->fill($data);
            $lot->save();
        } elseif ($request['action'] == 'delete') {
            $lot->delete();
        }

        return redirect()->route('main.lot.index', compact( 'lot'));
    }

    private function rules()
    {
        $rules = [
            'title' => 'required|string',
            'lot_description' => 'required|string',
            'image' => 'required|file',
            'start_price' => 'required|integer',
            'date_finish' => 'required|date|after_or_equal:today',
            'step' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
        ];

        return $rules;
    }

}
