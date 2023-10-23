<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate($this->rules());
        $user = Auth::user();
        $categories = Category::all();
        $lotQuery = Lot::query();

        if (isset($data['title'])) {
            $lotQuery->where('title', 'like', "%{$data['title']}%");
        }

        if($request->has('category')){
            $categoryId = $request->input('category');
            $lotQuery->where('category_id', $categoryId);
        }

        $lots = $lotQuery->paginate(6);

        return view('main.index', compact('categories', 'user', 'lots'));
    }

    private function rules()
    {
        $rules = [
            'title' => 'nullable|string',
            'category_id' => 'exists,id',
        ];

        return $rules;
    }
}
