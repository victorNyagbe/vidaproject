<?php

namespace App\Http\Controllers\Guests;

use queue;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ClientStatus;
use App\Models\CollabStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    public function welcome()
    {
        return view('guests.welcome');
    }

    public function login()
    {
        return view('guests.login');
    }

    public function dashboard($token)
    {
        $page = 'guests.dashboard';

        return view('guests.dashboard', compact('page'));
    }


    // Partie partner (inviteLogin)

    public function inviteLogin()
    {
        $collab_statuses = CollabStatus::all();
        return view('partners.inviteLogin', compact('collab_statuses'));
    }

    public function inviteClientLogin()
    {
        $client_statuses = ClientStatus::all();
        return view('partners.addClientLogin', compact('client_statuses'));
    }

    public function inviteLoginConnexion()
    {
        return view('partners.inviteLoginConnexion');
    }

    public function partner_login(Request $request)
    {
        $request->validate([
            'loginEmail' => 'required',
            'loginPassword' => 'required'
        ], [
            'loginEmail.required' => 'Veuillez renseigner l\'adresse mail de votre compte',
            'loginPassword.required' => 'Veuillez renseigner votre mot de passe'
        ]);

        $response = [];
        $status = '';

        $findEmail = User::where('email', $request->loginEmail)->first();

        if ($findEmail == null) {
            $status = 'email_error';
            return $response = [
                'message' => 'Adresse mail incorrect',
                'status' => $status
            ];
        } else {

            if (Hash::check($request->loginPassword, $findEmail->password)) {

                session()->put('id', $findEmail->id);
                session()->put('email', $findEmail->email);
                session()->put('profile', $findEmail->profile);
                session()->put('isAuthenticated', true);
                session()->put('fullname', $findEmail->fullname);

                // $yourId = session()->get('id');

                $cookie_user_id = Cookie::get('id', session()->get('id'));

                // $cookie_user_id = Cookie::queue('id', session()->get('id'), 4555);

                // $status = 'success';
                // return $response = [
                //     'message' => route('admin.project.project'),
                //     'status' => $status
                // ];

                // return View::make('admin.project.project')->withCookie($cookie_user_id);

                $projects = Project::all();
                $types = ProjectType::all();
                $page = 'admin.project';

                return view('admin.project.project', compact('projects', 'types', 'page', 'cookie_user_id'));

                // return redirect()->route('admin.project.project')->withCookie('cookie_user_id')->get('/');

            } else {
                $status = 'password_error';
                return $response = [
                    'message' => 'Mot de passe incorrect',
                    'status' => $status
                ];
            }
        }
    }
}
