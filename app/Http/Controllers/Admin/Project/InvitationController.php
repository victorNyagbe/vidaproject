<?php

namespace App\Http\Controllers\Admin\Project;

use App\Models\Invitation;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class InvitationController extends Controller
{
    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation) {
            abort(404); // Lien d'invitation invalide
        }

        return view('guests.login')->with('invitation', true);

    }

    public function accepter(Invitation $invitation)
    {
        $invitation = Invitation::where('id', $invitation->id)->first();

        if (!$invitation) {
            abort(404); // Lien d'invitation invalide
        }

        $invitation->update(['status' => 'acceptee']);

        $collab = ProjectUser::where('user_mail', $invitation->email)->where('project_id', $invitation->project_id)->first();

        $collab->update(['status' => 1]);

        // return Response::json(['success' => true]);

        return redirect()->route('admin.dashboard')->with('successModal', true);

    }

    public function rejeter(Invitation $invitation)
    {
        $invitation = Invitation::where('id', $invitation->id)->first();

        if (!$invitation) {
            abort(404); // Lien d'invitation invalide
        }

        $invitation->update(['status' => 'refusee']);

        $collab = ProjectUser::where('user_mail', $invitation->email)->where('project_id', $invitation->project_id)->first();

        $collab->delete();

        // $collab->update(['status' => 0]);

        return redirect()->route('admin.dashboard')->with('failureModal', true);

    }

}
