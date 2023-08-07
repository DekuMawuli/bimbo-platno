<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function signIn(){
        return view("auth.login");
    }


    public function processSignIn(Request $request){
     $validatedData = $request->validate([
            "email" => "required|email",
            "password" => "required",
     ]);

     if (Auth::attempt($validatedData)){
         return redirect()->route("admin.dashboard");
     }
     session()->flash("alert-type", "danger");
     session()->flash("alert-message", "Invalid Credentials... Please Try Again");
     return redirect(route("auth.login"));
    }

    public function signUp(){
        return view("auth.register");
    }

    public function processSignUp(Request $request){
        $validatedData = $request->validate([
            "email" => "required|email|unique:users,email",
            "name" => "required|string|max:100|unique:users,name",
            "password" => "required|min:6",
            "confirm_password" => "required|same:password|min:6",
        ]);
       $user =  User::create([
            "email" => $validatedData['email'],
            "name" => $validatedData['name'],
            "password" => Hash::make($validatedData['password']),
        ]);

       if ($user){
           Auth::login($user);
           return redirect()->route("admin.dashboard");
       }
    }
}
