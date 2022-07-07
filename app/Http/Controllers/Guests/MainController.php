<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome()
    {
        return view('guests.welcome');
    }

    public function login()
    {
        return view('guests.login');
    }
}
