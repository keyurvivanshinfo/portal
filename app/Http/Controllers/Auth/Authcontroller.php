<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class Authcontroller extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function registration()
    {
        return view('auth.registration');
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword');
    }




    public function postRegister(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required|alpha_num|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
        ]);

        $data = $request->all();
        $createUser = $this->create($data);
        return redirect()->route('login')->withSuccess('registered user');
    }

    public function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $userOrEmail = $request->input('email');
        $type = filter_var($userOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
       
        
        $checlLoginCredentials = [$type=>$request->input('email'),"password" =>$request->input('password')];

        if (Auth::attempt($checlLoginCredentials)) {
            Session(['username' => Auth::user()->username]);
            if(Auth::user()->role=='0'){
                return redirect('userDashboard')->withSuccess('you are logged in');
            }else if(Auth::user()->role=='1'){
                return redirect('adminDashboard')->withSuccess('you are logged in');
            }
        } else {
            return redirect()->route('login')->withSuccess('incorrect id or password');
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
