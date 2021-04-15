<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use App\Models\Permission;

class Create extends Component
{
    public $name;
    public $displayName;
    public $description;

    public function render()
    {
        return view('livewire.admin.permission.create');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'displayName' => ['required', 'string', 'min:2', 'max:100'],
            'description' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        if (request()->user()->isAbleTo('permissions-create')) {
            Permission::create([
                'name' => $this->name,
                'display_name' => $this->displayName,
                'description' => $this->description,
            ]);

            $this->emit('permissionStored');
            $this->emit('refreshPermission');
        } else {
            $this->emit('userProhibited');
        }
    }
}
