<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    // show register form page
    public static function create(){
        // show register create form
        return view("users.register");
    }
   
    // validate, create, and login in user ... 
    public static function store(Request $request){
        $formfields = $request->validate([
            "name"=>["required", "min:3"],
            "password" => ["required","confirmed", "min:8"],
            "email" => ["required","email", Rule::unique("users", "email")]
        ]);

        //hash Password
        $formfields["password"] = bcrypt($formfields["password"]);

        $user = User::create($formfields);
        
        // login user
        auth()->login($user);

        return redirect("/")->with("message", "user created and logged in");
    }

    // logout user 
    public static function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with("message", "your have been logged out");
    }

    // shoe login page
    public static function login(){
        return view("users.login");
    }
    
    // login user
    public static function authenticate(Request $request){
        $formfields = $request->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);
        if(auth()->attempt($formfields)){
            $request->session()->regenerate();
            return redirect("/")->with("message","You are succesfully logged in");
        }
        else{
            return back()->withErrors(["email"=> "invalid credentials"])->onlyInput("email");
        }
    } 
}
