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
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        $lotQuery = Lot::query();
        $lots = $lotQuery->paginate(6);

        return view('main.index', compact('categories', 'user', 'lots'));
    }
}
