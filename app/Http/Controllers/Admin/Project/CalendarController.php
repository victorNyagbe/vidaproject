<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendar()
    {
        $page = 'admin.projectBoard.calendar';
        return view('admin.projectBoard.calendar', compact('page'));
    }
}
