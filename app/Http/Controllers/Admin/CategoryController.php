<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categoryQuery = Category::query();

        $categories = $categoryQuery->paginate(6);

        return view('admin.category.index', compact('categories'));
    }

    public function view($categoryId)
    {
        $category = Category::find($categoryId);
        return view('admin.category.view', compact('category'));
    }


    public function form($categoryId = '')
    {
        $category = null;
        if (!empty($categoryId)) {
            $category = Category::query()->where('id',$categoryId)->first();
        }
            return view('admin.category.form', compact('category'));

    }

    public function actions(Request $request)
    {
        $category = $request['id'] ? Category::query()->findOrFail($request['id']) : new Category();


        if($request['action'] == 'create' || $request['action'] == 'update') {
            $data = $request->validate($this->rules());
            $category->fill($data);
            $category->save();
        } elseif ($request['action'] == 'delete') {
            $category->delete();
        }

        return redirect()->route('admin.category.index');
    }

    private function rules()
    {
        $rules = [
            'title' => 'required|string',
            'character_code' => 'required|string',
        ];
        return $rules;
    }

}
