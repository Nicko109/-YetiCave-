<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {
        $data['usersCount'] = User::all()->count();
        $data['categoriesCount'] = Category::all()->count();
        $data['lotsCount'] = Lot::all()->count();
        $data['betsCount'] = Bet::all()->count();
        return view('admin.main.index', compact('data'));
    }
}
