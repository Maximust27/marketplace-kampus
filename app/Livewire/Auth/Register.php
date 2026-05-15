<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

#[Title('Daftar Akun - CampusHub')]
#[Layout('components.layouts.app')]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $role = ''; 
    public $password = '';

    public function registerUser()
    {
        $validated = $this->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:mahasiswa,dosen,staf',
            'password' => 'required|min:8',
        ], [
            'role.required' => 'Silakan pilih peran Anda terlebih dahulu.',
            'role.in' => 'Peran yang dipilih tidak valid.',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        Auth::login($user);
        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}