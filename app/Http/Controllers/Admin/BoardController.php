<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function board()
    {
        $page = 'admin.board';
        return view('admin.board', compact('page'));
    }
}
