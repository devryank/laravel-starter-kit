<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public $name;

    protected $listeners = [
        'addName' => 'addNameHandler'
    ];

    public function render()
    {
        return view('livewire.admin.user.delete', [
            'name' => $this->name,
        ]);
    }

    public function addNameHandler($name)
    {
        $this->name = $name;
    }

    public function destroyUser()
    {
        $this->emit('destroyUser');
    }
}
