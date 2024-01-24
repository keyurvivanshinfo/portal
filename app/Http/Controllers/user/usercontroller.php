<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\images;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

use Faker\Extension\Extension;


class usercontroller extends Controller
{
    public function userDashboard()
    {
        return view('usersView.userDashboard');
    }

    // upload images function
    public function userUploadImage()
    {
        return view('usersView.userUploadImage');
    }


    public function userUploadImagePost(Request $request)
    {
        $request->validate([
            'image' => 'required'
        ]);

        
        if ($request->hasFile('image')) {

            $image = $request->file("image");

            $user = Auth::id();
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileToStore = $fileName . "_" . time()."." . $fileExt;
            
            
            
            if ($request->file('image')->storeAs('public/images', $fileToStore)) {
                echo "ok";
                images::create([
                    'uploaderId' => $user,
                    'imagePath' => $fileToStore
                ]);
                return redirect()->route('userUploadImage')->withSuccess("Uploaded image succesfully");
            } else {
                return redirect()->route('userUploadImage')->withSuccess("Uploaded image not succesfully");
            }
        }
    }
}
