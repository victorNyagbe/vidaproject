<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivationAccountToken;
use App\Models\Invitation;
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

        // $add_confirmation = ActivationAccountToken::where('email', $user->email)->first();

        // if($add_confirmation != null) {

        //     if($add_confirmation->is_confirmated == 0) {

        //         $project_user = ProjectUser::where('id', $add_confirmation->project_user_id)->first();

        //         $project_user->update([
        //             'user_id' => $user->id
        //         ]);

        //         $add_confirmation->update([
        //             'is_confirmated' => 1
        //         ]);
        //     }

        // }

       $add_confirmation = ActivationAccountToken::where('email', $user->email)->first();

        if ($add_confirmation != null) {

            $project_users = ProjectUser::where('user_mail', $add_confirmation->email)->get();

            $invitations = Invitation::where('email', $add_confirmation->email)->get();

            foreach ($project_users as $project_user) {

                $project_user->update(['user_id' => $user->id]);

            }

            foreach ($invitations as $invitation) {

                $invitation->update(['user_id' => $user->id]);

            }

            ActivationAccountToken::where('email', $add_confirmation->email)->delete();
        }

        // $token = $request->input('token');

        // dd($token);

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

        // $add_confirmation = ActivationAccountToken::where('email', $user->email)->first();

        // if($add_confirmation != null) {

        //     if($add_confirmation->is_confirmated == 0) {

        //         $project_user = ProjectUser::where('id', $add_confirmation->project_user_id)->first();

        //         $project_user->update([
        //             'user_id' => $user->id
        //         ]);

        //         $add_confirmation->update([
        //             'is_confirmated' => 1
        //         ]);
        //     }

        // }

        $add_confirmation = ActivationAccountToken::where('email', $user->email)->first();

        if ($add_confirmation != null) {

            $project_users = ProjectUser::where('user_mail', $add_confirmation->email)->get();

            foreach ($project_users as $project_user) {

                $project_user->update(['user_id' => $user->id]);

            }

            ActivationAccountToken::where('email', $add_confirmation->email)->delete();
        }

    }
}
