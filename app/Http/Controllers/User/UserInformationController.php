<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserInformationController extends UserController
{
    //
    public function show_information()
    {
    	return view('user/information/show', ['user' => Auth::user(), 'current_selection'=>'information']) ;
    }

    public function update(Request $request)
    {
    	$id = Auth::user()->id;
    	$user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;        
        $user->subscription = ($request->subscription == "on")?1:0;

        if (!is_null($request->new_password))
        {
            $user->password = bcrypt($request->new_password);
        }

        $success = $user->save();
        return view('user/information/show', ['user' => Auth::user(), 'current_selection'=>'information', 'success' => $success]) ;
    }
}
