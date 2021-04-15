<?php

use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomeuser');
})->name('/');

Route::get('/auth', [\App\Http\Controllers\AuthController::class, 'index']);


Route::name('panel.')
    ->prefix('panel')
    ->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard.index')
            ->middleware(['auth' => 'role:superadmin|admin'])
            ->breadcrumbs(fn (Trail $trail) =>
            $trail->push('Panel')->push('Dashboard', route('panel.dashboard.index')));
        Route::get('user', \App\Http\Livewire\Admin\User\Index::class)
            ->name('user.index')
            ->middleware(['auth' => 'role:superadmin|admin'])
            ->breadcrumbs(fn (Trail $trail) =>
            $trail->push('Panel')->push('User', route('panel.user.index')));
        Route::get('permission', \App\Http\Livewire\Admin\Permission\Index::class)
            ->name('permission.index')
            ->middleware(['auth' => 'role:superadmin'])
            ->breadcrumbs(fn (Trail $trail) =>
            $trail->push('Panel')->push('Permission', route('panel.permission.index')));
        Route::get('role', \App\Http\Livewire\Admin\Role\Index::class)
            ->name('role.index')
            ->middleware(['auth' => 'role:superadmin'])
            ->breadcrumbs(fn (Trail $trail) =>
            $trail->push('Panel')->push('Role', route('panel.role.index')));
    });

Route::get('profile', \App\Http\Livewire\User\Profile::class)->name('profile')->middleware(['auth' => 'role:user']);

Route::get('register', function () {
    return 'Please create user from superadmin';
});
