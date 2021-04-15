<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $password;
    public $image;
    public $imageOld;

    public $edit = false;
    public $editPassword = false;

    public function render()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('livewire.user.profile', [
            'user' => $user
        ])
            ->extends('layouts.user')
            ->section('content');
    }

    public function openEdit()
    {
        $this->name = Auth::user()->name;
        $this->imageOld = Auth::user()->profile_photo_path;
        $this->edit = true;
    }

    public function editPassword()
    {
        $this->editPassword = true;
    }

    public function cancelEditPassword()
    {
        $this->editPassword = false;
    }

    public function store()
    {
        $user = User::findOrFail(Auth::user()->id);

        if (request()->user()->isAbleTo('users-update')) {
            if ($this->editPassword) {
                $this->validate([
                    'name' => ['required', 'min:3'],
                    'image' => ['required_without:name', 'max:1024'],
                    'password' => ['required', 'string', 'min:4'],
                ]);
                $password = Hash::make($this->password);
            } else {
                $this->validate([
                    'name' => ['required', 'min:3'],
                    'image' => ['required_without:name', 'max:1024'],
                ]);
                $password = $user->password;
            }


            if ($this->image) {
                $imageName = '';
                if ($user->profile_photo_path !== NULL) {
                    File::delete($user->profile_photo_path);
                }
                $imageName = \Str::slug($this->name, '-')
                    . '-'
                    . uniqid()
                    . '.' . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public/profile_photo/', $imageName, 'local');
                $imageName = 'storage/profile_photo/' . $imageName;
            } else {
                $imageName = $user->profile_photo_path;
            }

            $user->update([
                'name' => $this->name,
                'profile_photo_path' => $imageName,
                'password' => $password
            ]);
            // close form edit
            $this->edit = false;
            // if user edit password, redirect to login
            if ($this->editPassword) {
                return redirect(url('login'));
            }
        } else {
            // user doesn't able to update profile
            $this->edit = false;
            session()->flash('type', 'danger');
            session()->flash('message', "You don't have permission to access!");
        }
    }

    public function clearData()
    {
        $this->name = '';
        $this->password = '';
        $this->image = '';
        $this->imageOld = '';
    }
}
