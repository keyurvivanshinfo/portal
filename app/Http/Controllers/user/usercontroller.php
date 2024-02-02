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
            'images' => 'max:10',
            'images.*' => 'required|mimes:jpg,jpeg,png|max:20000'
        ]);


        $images = $request->file('images');
        $numberOfFiles = count($request->file('images'));

        $cnt = 0;

        if ($request->hasFile('images')) {


            $user = Auth::id();
            echo $user;
            foreach ($images as $image) {

                $fileNameWithExt = $image->getClientOriginalName();
                $fileExt = $image->getClientOriginalExtension();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $fileToStore = $fileName . "_" . time() . "." . $fileExt;



                if ($image->storeAs('public/images', $fileToStore)) {
                    images::create([
                        'uploaderId' => $user,
                        'imagePath' => $fileToStore
                    ]);

                    $cnt++;
                }
            }
            echo "num" . $numberOfFiles;
            echo "cnt" . $cnt;
            if ($numberOfFiles == $cnt) {
                return redirect()->route('userUploadImage')->withSuccess("All images uploaded succesfully");
            } else {
                return redirect()->route('userUploadImage')->withSuccess("Some image may not be uploaded");
            }
        } else {
            return redirect()->route('userUploadImage')->withSuccess("Please select the file");
        }
    }

    public function editUserByUser(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
        ]);
        $user = User::find($request->id);
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
        ]);
        return redirect()->route('userDashboard')->with("success", "Profile Updated successfully");
    }


    public function editUserByUserView()
    {
        $user = Auth::user();
        return view('usersView.editUserByUserView')->with('user', $user);
    }


    public function viewMyImages()
    {
        $userId = Auth::user()->id;
        $data = images::where("uploaderId", $userId)->get();


        return view('usersView.viewMyImages')->with("images", $data);
    }


    public function downloadImage($path)
    {
        $file = ("storage/images/$path");
        return response()->download($file);
    }

    public function deleteImage($id)
    {
        
        $file = images::where("productId", $id)->first();
        $fileName = $file->imagePath;

        $delete = images::where('productId', $id)->delete();

        if ($delete) {
            unlink(public_path() . "/storage/images/" . $fileName);
            return back()->with("success", "Image Deleted Successfully!");
        } else {
            return back()->with("error", "Error Occured! Try Again Later.");
        }
    }
}
