<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $usersQuery = User::query();

        $users = $usersQuery->paginate(4);

        return view('admin.user.index', compact('users'));
    }

    public function view($userId)
    {
        $user = User::find($userId);
        return view('admin.user.view', compact('user'));
    }

    public function form($userId = '')
    {
        $roles = User::getRoles();

        $user = null;

        if (!empty($userId)) {
            $user = User::query()->where('id', $userId)->first();
        }

        return view('admin.user.form', compact('roles', 'user'));
    }

    public function actions(Request $request)
    {
        $user = $request['id'] ? User::query()->findOrFail($request['id']) : new User();


        if($request['action'] == 'create' || $request['action'] == 'update') {
            $data = $request->validate($this->rules());
            $data['password'] = Hash::make($data['password']);
            $data['avatar'] = Storage::put('/images', $data['avatar']);
            $user->fill($data);
            $user->save();
        } elseif ($request['action'] == 'delete') {
            $user->delete();
        }

        return redirect()->route('admin.user.index');
    }

    private function rules()
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'role' => 'required|integer',
            'contacts' => 'required|string',
            'avatar' => 'required|file',
        ];

        return $rules;
    }

}
