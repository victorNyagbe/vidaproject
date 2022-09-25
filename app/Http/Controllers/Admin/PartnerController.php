<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function client()
    {
        $page = 'admin.client';
        return view('admin.client', compact('page'));
    }

    public function collaborateur()
    {
        $page = 'admin.collaborateur';
        return view('admin.collaborateur', compact('page'));
    }
}
