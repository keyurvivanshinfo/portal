<?php

namespace App\Http\Controllers\Auth;

// DB
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;


// models
use App\Models\User;
use App\Models\forgotPassword;

// mail
use App\Mail\resetPasswordMail;


// custome request
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\ForgotPasswordRequest;

class Authcontroller extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // forgot password send link to the user
    public function forgotPasswordPost(ForgotPasswordRequest $request)
    {

        $deleteToken = forgotPassword::where('email',$request->input('email'))->first();
        if($deleteToken){
            $deleteToken->delete();
        }
            

        $reset_token = crypt::encryptString($request->token + time());

        if ($reset_token) {
            $forgotPassword = new forgotPassword;
            $forgotPassword->email = $request->input('email');
            $forgotPassword->token = $reset_token;

            $forgotPassword->save();

            $maildata = [
                'receiver' => $request->input('email'),
                'token' => $reset_token
            ];

            if (Mail::to($request->input('email'))->send(new resetPasswordMail($maildata))) {
                return redirect()->route('login')->with('success', 'Password reset link has been sent to your email');
            } else {
                return redirect()->back()->withInput()->withErrors(['faild' => "Failed To Send Email"]);
            }
        }
    }

    public function resetPasswordForm($email, $token)
    {
        $checkToken = forgotPassword::where('email', $email)->where('token', $token)->first();

        if ($checkToken) {
            return view('auth.resetPasswordForm', compact('email', 'token'));
        } else {
            return redirect('/login')->with('failed', 'Invalid Link Or Token Expired! Please Try Again Later');
        }
    }


    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirmPassword' => 'required'
        ]);

        //Check If The Password And Confirmation Are Matching
        if ($request->input('password') !== $request->input('confirmPassword')) {
            return back()->withErrors(['notMatch' => 'The password does not match the confirmation password']);
        } else {
            $updatePassword = forgotPassword::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if ($updatePassword) {
                $user = User::where('email', $updatePassword->email)->first();
                $user->password = ($request->password);
                $user->save();
                // DB::table('forgot_passwords')->where('email', $request->input('email'))->delete();
                forgotPassword::where('email', $request->input('email'))->delete();
                return redirect()->route('login')->withSuccess('Password updated successfully');
            } else {
                return back()->with(['success' => 'time out please generate new password reset link']);
            }
        }
    }




    public function postRegister(RegisterUserRequest $request)
    {

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

    public function postLogin(LoginUserRequest $request)
    {


        $userOrEmail = $request->input('email');
        $type = filter_var($userOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $checlLoginCredentials = [$type => $request->input('email'), "password" => $request->input('password')];

        if (Auth::attempt($checlLoginCredentials)) {
            Session(['username' => Auth::user()->username]);
            if (Auth::user()->role == '0') {
                return redirect('userDashboard')->withSuccess('you are logged in');
            } else if (Auth::user()->role == '1') {
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
