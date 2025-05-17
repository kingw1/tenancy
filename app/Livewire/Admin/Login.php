<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.default')]
class Login extends Component
{
    public string $username;
    public string $password;

    public function login()
    {
        $credentials = $this->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return $this->redirectIntended(route('admin.dashboard'));
        } else {
            session()->flash('message', __('auth.failed'));

            return $this->redirectRoute('admin.login');
        }
    }

    public function render()
    {
        return view('livewire.admin.login');
    }
}
