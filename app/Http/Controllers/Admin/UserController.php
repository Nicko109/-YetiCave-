<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    public function forms()
    {
        $roles = User::getRoles();

        return view('admin.user.create', compact('roles'));
    }

    public function actions(StoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        User::firstOrCreate(['email' => $data['email']], $data);

        $data['avatar'] = Storage::put('/images', $data['avatar']);


        return redirect()->route('admin.user.index');
    }
}
