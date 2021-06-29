<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $title = 'Users';
    public $search;
    public $paginate = 10;
    public $modalCreate = false;
    public $modalUpdate = false;
    public $modalDelete = false;
    public $userId;

    protected $updateQueryString = [
        ['search' => ['except' => '']]
    ];

    protected $listeners = [
        'refreshUser' => '$refresh',
        'createUser' => 'createUserHandler',
        'modalClose' => 'modalCloseHandler',
        'userStored' => 'userStoredHandler',
        'userUpdated' => 'userUpdatedHandler',
        'destroyUser' => 'destroyUserHandler',
        'userProhibited' => 'userProhibitedHandler',
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        if (request()->user()->isAbleTo('users-read')) {
            $users = $this->search === NULL ?
                User::orderBy('id', 'asc')->paginate($this->paginate) :
                User::orderBy('id', 'asc')->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        } else {
            $users = false;
        }
        return view('livewire.admin.user.index', [

            'users' => $users,
        ])
            ->extends('layouts.dashboard')
            ->section('content');
    }

    public function createUserHandler()
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

    public function userStoredHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Successfully created user');
    }

    public function editUser($userId)
    {
        $this->openModalUpdate();

        $this->emit('editUser', $userId);
    }

    public function userUpdatedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Successfully updated user');
    }

    public function deleteUser($userId)
    {
        if (request()->user()->isAbleTo('users-delete')) {
            $this->userId = $userId;
            $name = User::findOrFail($userId)->name;

            $this->emit('addName', $name);
            $this->openModalDelete();
        } else {
            $this->emit('userProhibited');
        }
    }

    public function destroyUserHandler()
    {
        $user = User::find($this->userId);
        $user->delete();
        $this->modalCloseHandler();
        session()->flash('type', 'success');
        session()->flash('message', 'Successfully deleted user');
    }

    public function userProhibitedHandler()
    {
        $this->modalCloseHandler();
        session()->flash('type', 'danger');
        session()->flash('message', "You don't have permission to access!");
    }
}
