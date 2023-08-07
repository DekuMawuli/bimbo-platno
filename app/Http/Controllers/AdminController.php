<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.home");
    }

    public function signOut(){
        Auth::logout();
        session()->flush();
        session()->regenerateToken();
        return redirect(route("auth.login"));

    }

}
