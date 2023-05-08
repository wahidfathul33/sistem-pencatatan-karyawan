<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $remember_me = false;

    protected array $rules = [
        'email'      => ['required', 'email'],
        'password'   => ['required'],
    ];

    public function render()
    {
        return view('livewire.auth.login-form');
    }

    public function submitLogin()
    {
        $this->validate();

        $throttleKey = str()->lower($this->email) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts(key: $throttleKey, maxAttempts: 3)) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));
        }

        if (!auth()->attempt($this->only(['email', 'password']), $this->remember_me)) {

            RateLimiter::hit($throttleKey);

            session()->flash('error', [
                'title' => 'Kredensial salah',
                'message' => 'Cek kembali email dan password Anda!'
            ]);

            return false;
        }

        return to_route('home');
    }
}
