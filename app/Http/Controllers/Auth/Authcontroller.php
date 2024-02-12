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
use App\Models\Role;
use App\Models\forgotPassword;

// mail
use App\Mail\resetPasswordMail;

// jobs
use App\Jobs\SendMail;


// custome request
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\ForgotPasswordRequest;

class Authcontroller extends Controller
{
    // return login page view
    // public function index()
    // {
    //     return view('auth.login');
    // }


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


            if (SendMail::dispatch($request->input('email'),$maildata)) {
                return redirect()->route('login')->with('success', 'Password reset link has been sent to your email');
            } else {
                return redirect()->back()->withInput()->withErrors(['faild' => "Failed To Send Email"]);
            }

        }
    }


    // redirect to the enter new  password page along with the  token from email 
    public function resetPasswordForm($email, $token)
    {
        $checkToken = forgotPassword::where('email', $email)->where('token', $token)->first();

        if ($checkToken != NULL) {
            return view('auth.resetPasswordForm', compact('email', 'token'));
        } else {
            return redirect()->route('forgotPassword')->withSuccess('Invalid Link Or Token Expired! Please Try Again');
        }
    }


    // save new reseted password
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
                forgotPassword::where('email', $request->input('email'))->delete();
                return redirect()->route('login')->withSuccess('Password updated successfully');
            } else {
                return back()->with(['success' => 'time out please generate new password reset link']);
            }
        }
    }



    // register user
    public function postRegister(RegisterUserRequest $request)
    {

        $data = $request->all();
        $createUser = $this->create($data);

        $createUser->roles()->attach([1]);
        // ['created_at' => now()->format('d-m-Y H:i:s'),d]
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


    // authentication
    public function postLogin(LoginUserRequest $request)
    {

        $userOrEmail = $request->input('email');
        $type = filter_var($userOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $checkLoginCredentials = [$type => $request->input('email'), "password" => $request->input('password')];

        if (Auth::attempt($checkLoginCredentials)) {
            Session(['username' => Auth::user()->username]);

            // echo "ok";

            $uid = Auth::user()->id;
            $role= User::find($uid)->roles->first()->id;


            if ($role==1) {
                return redirect('userDashboard')->withSuccess('you are logged in');
            } else if ($role==3) {
                return redirect('adminDashboard')->withSuccess('you are logged in');
            } else if ($role==2) {
                return redirect('editorDashboard')->withSuccess('you are logged in');
            }
        } else {
            return redirect()->route('login')->withSuccess('incorrect id or password');
        }
    }

    // logout the current  user and destroy session
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
