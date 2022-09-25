<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat()
    {
        $page = 'admin.message';
        return view('admin.message.chat', compact('page'));
    }
}
