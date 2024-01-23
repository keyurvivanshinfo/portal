<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class admincontrolle extends Controller
{
    public function adminDashboard(){
        return view('admin.adminDashboard');
    }
    public function adminUploadImage(){
        return view('admin.adminUploadImage');
    }
}
