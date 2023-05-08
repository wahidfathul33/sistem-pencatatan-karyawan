<?php

namespace App\Http\Livewire\Auth;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class RegisterForm extends Component
{
    use UserRegisterRequest;

    public $full_name, $email, $password, $password_confirmation;

    public function render()
    {
        abort_if(!$this->authorize(), 403);

        return view('livewire.auth.register-form');
    }

    public function submitRegister()
    {
        $validatedData = $this->validate($this->rules());

        $user = User::create($validatedData);

        auth()->login($user, true);

        event(new Registered($user));

        return to_route('auth.login');
    }
}
