<?php

namespace App\Http\Livewire\Admin\Permission;

use App\Models\Permission;
use Livewire\Component;

class Index extends Component
{
    public $title = 'Permissions';
    public $search;
    public $paginate = 10;
    public $modalCreate = false;
    public $modalUpdate = false;
    public $modalDelete = false;
    public $permissionId;

    protected $listeners = [
        'refreshPermission' => '$refresh',
        'createPermission' => 'createPermissionHandler',
        'modalClose' => 'modalCloseHandler',
        'permissionStored' => 'permissionStoredHandler',
        'permissionUpdated' => 'permissionUpdatedHandler',
        'destroyPermission' => 'destroyPermissionHandler',
        'userProhibited' => 'userProhibitedHandler',
    ];
    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {
        if (request()->user()->isAbleTo('permissions-read')) {
            $permissions = $this->search === NULL ?
                Permission::orderBy('id', 'asc')->paginate($this->paginate) :
                Permission::orderBy('id', 'asc')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        } else {
            $permissions = false;
        }
        return view('livewire.admin.permission.index', [
            'permissions' => $permissions,
        ])
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function createPermissionHandler()
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

    public function permissionStoredHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Permission has been created');
    }

    public function editPermission($permissionId)
    {
        $this->openModalUpdate();

        $this->emit('editPermission', $permissionId);
    }

    public function permissionUpdatedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Permission has been updated');
    }

    public function deletePermission($permissionId)
    {
        if (request()->user()->isAbleTo('permissions-delete')) {
            $this->permissionId = $permissionId;
            $name = Permission::findOrFail($permissionId)->display_name;

            $this->emit('addName', $name);
            $this->openModalDelete();
        } else {
            $this->emit('userProhibited');
        }
    }

    public function destroyPermissionHandler()
    {
        $user = Permission::find($this->permissionId);
        $user->delete();
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Permission has been deleted');
    }

    public function userProhibitedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'danger');
        session()->flash('message', "You don't have permission to access!");
    }
}
