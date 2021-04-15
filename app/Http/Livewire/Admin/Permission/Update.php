<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;

class Update extends Component
{
    public $permissionId;
    public $name;
    public $displayName;
    public $description;

    protected $listeners = [
        'editPermission' => 'editPermissionHandler',
    ];

    public function render()
    {
        return view('livewire.admin.permission.update');
    }
    public function editPermissionHandler($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $this->permissionId = $permission['id'];
        $this->name = $permission['name'];
        $this->displayName = $permission['display_name'];
        $this->description = $permission['description'];
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'displayName' => ['required', 'string', 'min:2', 'max:100'],
            'description' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        if ($this->permissionId) {
            if (request()->user()->isAbleTo('permissions-update')) {
                $permission = Permission::findOrFail($this->permissionId);
                $permission->update([
                    'name' => $this->name,
                    'display_name' => $this->displayName,
                    'description' => $this->description,
                ]);

                $this->emit('permissionUpdated');
            } else {
                $this->emit('userProhibited');
            }
        }
    }
}
