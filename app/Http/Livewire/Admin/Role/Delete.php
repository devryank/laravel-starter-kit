<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;

class Delete extends Component
{
    public $name;

    protected $listeners = [
        'addName' => 'addNameHandler'
    ];

    public function render()
    {
        return view('livewire.admin.role.delete', [
            'name' => $this->name,
        ]);
    }

    public function addNameHandler($name)
    {
        $this->name = $name;
    }

    public function destroyRole()
    {
        $this->emit('destroyRole');
    }
}
