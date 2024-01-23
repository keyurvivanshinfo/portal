<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class usercontroller extends Controller
{
    public function userDashboard(){
        return view('usersView.userDashboard');
    }

    // upload images function
    public function userUploadImage(){
        return view('usersView.userUploadImage');
    }
}
