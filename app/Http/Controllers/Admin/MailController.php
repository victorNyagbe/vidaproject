<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function mail()
    {
        $page = 'admin.email';
        return view('admin.email.mail', compact('page'));
    }

    public function getInbox()
    {
        return view('admin.email.inboxMail');
    }

    public function getNewMail()
    {
        return view('admin.email.newMail');
    }

    public function getSentMail()
    {
        return view('admin.email.sentMail');
    }

    public function getDraftMail()
    {
        return view('admin.email.draftMail');
    }

    public function getTrashMail()
    {
        return view('admin.email.trashMail');
    }
}
