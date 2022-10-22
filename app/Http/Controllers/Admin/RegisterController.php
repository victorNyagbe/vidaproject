<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function registerNewUser(Request $request)
    {
        $request->validate([
            'registerFirstName' => 'required',
            'registerLastName' => 'required',
            'registerEmail' => 'required|unique:users,email|email:rfc,dns',
            'registerPassword' => 'required|confirmed'
        ], [
            'registerFirstName.required' => 'Veuillez renseigner votre prénom',
            'registerLastName.required' => 'Veuillez renseigner votre nom',
            'registerEmail.required' => 'Veuillez renseigner votre email',
            'registerEmail.unique' => 'Ce mail a déjà été utilisé',
            'registerEmail.email' => 'Votre adresse mail est incorrect',
            'registerPassword.required' => 'Veuillez renseigner votre mot de passe',
            'registerPassword.confirmed' => 'Les mot de passe ne sont pas conformes'
        ]);

       $user = User::create([
            'fullname' => $request->registerFirstName . ' ' . $request->registerLastName,
            'email' => $request->registerEmail,
            'password' => Hash::make($request->registerPassword)
        ]);

        $fullname = $request->registerFirstName . ' ' . $request->registerLastName;

        session()->put('id', $user->id);
        session()->put('email', $user->email);
        session()->put('fullname', $user->fullname);
        session()->put('profile', $user->profile);
        session()->put('isAuthenticated', true);

        return route('admin.dashboard');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user);

        return redirect()->route('admin.dashboard');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();

        if (!$user) {
            $user = User::create([
                'fullname' => $data->name,
                'email' => $data->email,
                'google_id' => $data->id,
                'profile' => $data->avatar
            ]);
        }

        session()->put('id', $user->id);
        session()->put('email', $user->email);
        session()->put('fullname', $user->fullname);
        session()->put('profile', $user->profile);
        session()->put('isAuthenticated', true);
    }
}
