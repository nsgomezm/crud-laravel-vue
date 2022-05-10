<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function login(Request $request){
        $userdata = [
			'email' => $request->email,
			'password' => $request->password,
		];

		if (\Auth::attempt($userdata, true)) {
			return redirect()->route('home');
		} else {

			session()->flash('message', 'Username or Password incorrect');
			return back();
		}
    }

    public function logout(){
        \Auth::logout();
        redirect()->route('home');
    }
}
