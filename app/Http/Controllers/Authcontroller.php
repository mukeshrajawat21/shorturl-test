<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class Authcontroller extends Controller
{


  public  function index () {
    return view('login');
  }


public function login(Request $request)
{
   
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('dashboard')->with('success', 'Login successfully');
    } else {
        
        return back()->with('error' ,'Invalid email or password');
    }
}

public function logout(Request $request)
{
   Auth::logout();
   return redirect()->route('login');
}


}
