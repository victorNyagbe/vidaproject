<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat()
    {
        $page = 'admin.projectBoard.message';
        return view('admin.projectBoard.message.chat', compact('page'));
    }
}
