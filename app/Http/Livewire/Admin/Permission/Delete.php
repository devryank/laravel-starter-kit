<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;

class Delete extends Component
{
    public $name;

    protected $listeners = [
        'addName' => 'addNameHandler'
    ];

    public function render()
    {
        return view('livewire.admin.permission.delete', [
            'name' => $this->name,
        ]);
    }

    public function addNameHandler($name)
    {
        $this->name = $name;
    }
    public function destroyPermission()
    {
        $this->emit('destroyPermission');
    }
}
