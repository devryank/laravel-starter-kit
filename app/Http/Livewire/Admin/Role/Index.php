<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\Permission;

class Index extends Component
{
    public $title = 'Roles';
    public $search;
    public $paginate = 10;
    public $modalCreate = false;
    public $modalUpdate = false;
    public $modalDelete = false;
    public $permissionId;
    public $roleId;

    protected $listeners = [
        'refreshRole' => '$refresh',
        'createRole' => 'createRoleHandler',
        'modalClose' => 'modalCloseHandler',
        'roleStored' => 'roleStoredHandler',
        'roleUpdated' => 'roleUpdatedHandler',
        'destroyRole' => 'destroyRoleHandler',
        'userProhibited' => 'userProhibitedHandler',
    ];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        if (request()->user()->isAbleTo('roles-read')) {
            $roles = $this->search === NULL ?
                Role::orderBy('id', 'asc')->paginate($this->paginate) :
                Role::orderBy('id', 'asc')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        } else {
            $roles = false;
        }
        return view('livewire.admin.role.index', [
            'roles' => $roles,
        ])
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function createRoleHandler()
    {
        $this->openModalCreate();
    }

    public function openModalCreate()
    {
        $this->modalCreate = true;
    }

    public function openModalUpdate()
    {
        $this->modalUpdate = true;
    }

    public function openModalDelete()
    {
        $this->modalDelete = true;
    }

    public function modalCloseHandler()
    {
        $this->modalCreate = false;
        $this->modalUpdate = false;
        $this->modalDelete = false;
    }

    public function roleStoredHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Role has been created');
    }

    public function editRole($roleId)
    {
        $this->openModalUpdate();

        $this->emit('editRole', $roleId);
    }

    public function roleUpdatedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Role has been updated');
    }

    public function deleteRole($roleId)
    {
        if (request()->user()->isAbleTo('roles-delete')) {
            $this->roleId = $roleId;
            $name = Role::findOrFail($roleId)->display_name;

            $this->emit('addName', $name);
            $this->openModalDelete();
        } else {
            $this->emit('userProhibited');
        }
    }

    public function destroyRoleHandler()
    {
        $role = Role::find($this->roleId);
        $role->detachPermissions($role->permissions()->get()->pluck('id')->toArray());
        $role->delete();

        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Role has been deleted');
    }

    public function userProhibitedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'danger');
        session()->flash('message', "You don't have role to access!");
    }
}
