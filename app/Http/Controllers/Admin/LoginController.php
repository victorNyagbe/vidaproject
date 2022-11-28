<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
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

            $checkIfEmailUserIsForGoogleOrNot = User::where([
                ['email', $request->loginEmail],
                ['password', null],
                ['google_id', '<>', null]
            ])->first();

            if ($checkIfEmailUserIsForGoogleOrNot != null) {
                $status = '800';
                return $response = [
                    'message' => "connexion impossible avec ce mail. Veuillez vous connecter via google avec ce mail",
                    'status' => $status
                ];
            }

            if (Hash::check($request->loginPassword, $findEmail->password)) {

                session()->put('id', $findEmail->id);
                session()->put('email', $findEmail->email);
                session()->put('profile', $findEmail->profile);
                session()->put('isAuthenticated', true);
                session()->put('fullname', $findEmail->fullname);

                $status = 'success';
                return $response = [
                    'message' => route('admin.dashboard'),
                    'status' => $status
                ];

                return route('admin.dashboard');
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
