<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Update extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $roleId;

    public $editPassword = false;

    protected $listeners = [
        'editUser' => 'editUserHandler',
    ];

    public function render()
    {
        return view('livewire.admin.user.update', [
            'roles' => Role::all(),
        ]);
    }
    public function editUserHandler($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->roleId = $user->roles[0]->id;
    }

    public function editPassword()
    {
        $this->editPassword = true;
    }

    public function cancelEditPassword()
    {
        $this->editPassword = false;
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);

        if ($this->editPassword) {
            $this->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string'],
                'password' => ['required', 'string', 'min:4'],
                'roleId' => ['required']
            ]);
            $password = Hash::make($this->password);
        } else {
            $this->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string'],
                'roleId' => ['required']
            ]);
            $password = $user->password;
        }

        if ($this->userId) {
            if (request()->user()->isAbleTo('users-update')) {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => $password,
                ]);

                $roles = $user->roles;
                foreach ($roles as $role) {
                    $user->detachRole($role);
                }
                $role = Role::findOrFail($this->roleId);
                $user->attachRole($role);

                $this->editPassword = false;
                $this->emit('userUpdated');
            } else {
                $this->emit('userProhibited');
            }
        }
    }
}
