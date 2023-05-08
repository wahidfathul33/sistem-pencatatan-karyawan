<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return to_route('home')->with('success', ['title' => 'Berhasil!', 'message' => 'Email anda telah diverifikasi.']);
    }

    public function sendEmail()
    {
        auth()->user()->sendEmailVerificationNotification();

        return back()->with('success', ['title' => 'Berhasil!', 'message' => 'Kirim ulang verifikasi email berhasil.']);
    }
}
