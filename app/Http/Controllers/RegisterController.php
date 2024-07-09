<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required','unique:users'],
            'password' => 'required',
        ]);

        $validatedData['password']=bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('Success','Regristration Successfully');
    }
}
