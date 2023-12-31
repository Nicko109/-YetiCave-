<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
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

        $lots = $lotQuery->orderBy('created_at', 'desc')->paginate(6);

        if ($request->user() !== null) {
            return redirect()->route('main.index');
        }

        return view('main.guest', compact('categories', 'user', 'lots'));
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
