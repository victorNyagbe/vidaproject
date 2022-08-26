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
            if (Hash::check($request->loginPassword, $findEmail->password)) {
                session()->put('fullname', $findEmail->firstname . ' ' . $findEmail->lastname);

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
