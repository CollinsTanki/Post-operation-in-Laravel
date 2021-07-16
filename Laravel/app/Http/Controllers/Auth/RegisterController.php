<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
 public function index()
 {
     return view('auth.register');
 }
 public function store(Request $request)
 {
     //validation of register form
     $this->validate($request, [
     'name' => 'required|max:255',
     'username' =>'required|max:255',
     'email' => 'required|email|max:255',
     'password' => 'required|confirmed',

     ]);
     //store user
  user::create([
      'name' => $request->name,
      'username' => $request ->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),


  ]);
//   sign in the user
auth()->attempt($request->only('email', 'password'));
    //  redirect the user
    return redirect()->route('dashboard');

 }
}
