<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\BaseUserController;

class UserController extends BaseUserController
{
    public function getUserByCedula($cedula){
        return response()->json([
            'users' => User::where('cedula', $cedula)->first()
        ]);
    }
}
