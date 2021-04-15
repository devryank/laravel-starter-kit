<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class Create extends Component
{
    public $name;
    public $displayName;
    public $description;
    public $permissionId = [];

    public function render()
    {
        return view('livewire.admin.role.create', [
            'permissions' => Permission::all(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'displayName' => ['required', 'string', 'min:2', 'max:100'],
            'description' => ['required', 'string', 'min:2', 'max:100'],
            'permissionId' => ['required', 'array']
        ]);

        if (request()->user()->isAbleTo('roles-create')) {
            $role = Role::create([
                'name' => $this->name,
                'display_name' => $this->displayName,
                'description' => $this->description,
            ]);

            $role->attachPermissions($this->permissionId);

            $this->emit('roleStored');
            $this->emit('refreshRole');
        } else {
            $this->emit('userProhibited');
        }
    }
}
