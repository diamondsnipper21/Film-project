<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends AdminController
{

    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(9);
    	return view('admin/users/index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin/users/create');
    }

    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect(route('admin.users.index'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin/users/edit', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect(route('admin.users.index'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect(route('admin.users.index'));
    }
}
