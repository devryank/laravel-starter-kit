<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user')) {
            return redirect()->route('/');
        } else {
            return redirect()->route('panel.dashboard.index');
        }
    }
}
