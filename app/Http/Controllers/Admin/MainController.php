<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {
        $data = [];
        $data['usersCount'] = User::all()->count();
        $data['categoriesCount'] = Category::all()->count();
        $data['lotsCount'] = Lot::all()->count();
        $data['betsCount'] = Bet::all()->count();

        $startDate = $request->input('start_date', Carbon::now()->subDays(5));
        $endDate = $request->input('end_date', Carbon::now());

        $data['categoriesCreatedInPeriod'] = Category::whereBetween('created_at', [$startDate, $endDate])->count();
        $data['lotsCreatedInPeriod'] = Lot::whereBetween('created_at', [$startDate, $endDate])->count();
        $data['usersCreatedInPeriod'] = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $data['betsCreatedInPeriod'] = Bet::whereBetween('created_at', [$startDate, $endDate])->count();


        return view('admin.main.index', compact('data', 'startDate', 'endDate'));
    }
}
