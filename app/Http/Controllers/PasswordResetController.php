<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password as PasswordAlias;
use Password;

class PasswordResetController extends Controller
{
    public function passwordRequest()
    {
        return view('auth.forgot-password');
    }

    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === PasswordAlias::RESET_LINK_SENT
            ? back()->with('success', ['title' => 'Berhasil!', 'message' => __($status)])
            : back()->with('error', ['title' => 'Gagal!', 'message' => __($status)]);
    }

    public function passwordReset($token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(str()->random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === PasswordAlias::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('success', ['title' => 'Berhasil!', 'message' => __($status)])
            : back()->with('error', ['title' => 'Gagal!', 'message' => __($status)]);
    }
}
