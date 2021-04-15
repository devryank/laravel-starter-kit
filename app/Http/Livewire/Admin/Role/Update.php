<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class Update extends Component
{
    public $roleId;
    public $name;
    public $displayName;
    public $description;
    public $permissionId = [];

    protected $listeners = [
        'editRole' => 'editRoleHandler',
    ];

    public function render()
    {
        return view('livewire.admin.role.update', [
            'permissions' => Permission::all(),
        ]);
    }

    public function editRoleHandler($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->roleId = $role['id'];
        $this->name = $role['name'];
        $this->displayName = $role['display_name'];
        $this->description = $role['description'];
        // modify values array from int to string
        $this->permissionId = array_map('strval', $role->permissions()->get()->pluck('id')->toArray());
    }

    public function update()
    {
        $updatePermission = array_values(array_filter($this->permissionId));

        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'displayName' => ['required', 'string', 'min:2', 'max:100'],
            'description' => ['required', 'string', 'min:2', 'max:100'],
            'permissionId' => ['required', 'array']
        ]);

        if ($this->roleId) {
            if (request()->user()->isAbleTo('roles-update')) {
                $role = Role::findOrFail($this->roleId);
                $role->update([
                    'name' => $this->name,
                    'display_name' => $this->displayName,
                    'description' => $this->description,
                ]);

                $role->syncPermissions($updatePermission);
                $this->emit('roleUpdated');
            } else {
                $this->emit('userProhibited');
            }
        }
    }
}
