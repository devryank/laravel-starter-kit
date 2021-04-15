<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $roleId;

    public function render()
    {
        return view('livewire.admin.user.create', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
            'roleId' => ['required']
        ]);

        if (request()->user()->isAbleTo('users-create')) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'profile_photo_path' => 'img/profile.png',
            ]);

            $role = Role::findOrFail($this->roleId);
            $user->attachRole($role);

            $this->emit('userStored');
            $this->emit('refreshUser');
        } else {
            $this->emit('userProhibited');
        }
    }
}
