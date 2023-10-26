<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\FilterRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(FilterRequest $request)
    {
        $data = $request->validated();

        $role = $request->input('role', 'selected');

        $sort = $request->input('sort', 'asc');

        $column = $request->input('column', 'name');

        $userQuery = User::query();

        if ($role !== 'selected') {
            $userQuery->where('role', $role);
        }

        $userQuery->orderBy($column, $sort);

        if (isset($data['name']) || isset($data['email'])) {
            $userQuery->where(function ($query) use ($data) {
                if (isset($data['name'])) {
                    $query->orWhere('name', 'like', "%{$data['name']}%");
                }
                if (isset($data['email'])) {
                    $query->orWhere('email', 'like', "%{$data['email']}%");
                }
            });
        }

        if ($role !== 'selected') {
            $userQuery->where('role', $role);
        }

        $userQuery->orderBy($column, $sort);

        $roles = User::getRoles();

        $users = $userQuery->paginate(4);

        return view('admin.user.index', compact('users', 'roles'));
    }

    public function view($userId)
    {

        $categories = Category::all();

        $user = User::find($userId);

        $lots = Lot::where('user_id', $user->id)->paginate(6);
        return view('admin.user.view', compact('user', 'lots', 'categories'));
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
            $data = $request->validate($this->rules($user));
            $data['password'] = Hash::make($data['password']);
            $user->fill($data);
            $user->save();
        } elseif ($request['action'] == 'delete') {
            $user->delete();
        }

        return redirect()->route('admin.user.index');
    }

    private function rules(User $user)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'required|string',
            'role' => 'required|integer',
            'contacts' => 'string',
        ];

        return $rules;
    }

}
