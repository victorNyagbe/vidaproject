<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery()
    {
        $page = 'admin.gallery';
        return view('admin.gallery', compact('page'));
    }

    // project board

    public function projectGallery()
    {
        $page = 'admin.projectBoard.gallery';
        return view('admin.projectBoard.gallery', compact('page'));
    }
}
