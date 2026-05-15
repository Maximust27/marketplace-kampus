<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Title('Masuk - CampusHub')]
#[Layout('components.layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false; // Menambahkan fitur ingat saya

    public function authenticate()
    {
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Menyertakan variabel remember ke fungsi attempt
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        $this->addError('email', 'Email atau kata sandi salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}