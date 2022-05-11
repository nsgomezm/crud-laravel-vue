<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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
        Route::redirect()->route('home');
    }
}
