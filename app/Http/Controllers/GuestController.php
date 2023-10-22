<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->user() !== null) {
            return redirect()->route('main.index');
        }
        return view('main.guest', compact('categories'));
    }
}
