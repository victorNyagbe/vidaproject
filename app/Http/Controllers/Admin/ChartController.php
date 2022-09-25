<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart()
    {
        $page = 'admin.charts';
        return view('admin.charts', compact('page'));
    }

    public function projectChart()
    {
        $page = 'admin.projectBoard.charts';
        return view('admin.projectBoard.charts', compact('page'));
    }
}
