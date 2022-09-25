<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendar()
    {
        $page = 'admin.calendar';
        return view('admin.calendar', compact('page'));
    }
}
