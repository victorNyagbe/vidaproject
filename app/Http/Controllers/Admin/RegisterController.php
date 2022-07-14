<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerNewUser(Request $request)
    {
        $request->validate([
            'registerFirstName' => 'required',
            'registerLastName' => 'required',
            'registerFormEmail' => 'required|unique:users,email',
            'registerFormPassword' => 'required'
        ]);


    }
}
