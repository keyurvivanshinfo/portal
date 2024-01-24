<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\images;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class admincontrolle extends Controller
{
    public function adminDashboard(){
        return view('admin.adminDashboard');
    }
    public function adminUploadImage(){
        return view('admin.adminUploadImage');
    }

    public function adminUploadImagePost(Request $request)
    {
        try{
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
                    // echo "ok";
                    images::create([
                        'uploaderId' => $user,
                        'imagePath' => $fileToStore
                    ]);
                    return redirect()->route('adminUploadImage')->withSuccess("Uploaded image succesfully");
                } else {
                    return redirect()->route('adminUploadImage')->withSuccess("Uploaded image not succesfully");
                }
            }
        }catch(Exception $e){
            return redirect()->route("adminUploadImage")->withError($e->getMessage());
        }
    }

    public function adminViewAllUsersGet(){
        $users = User::where('username','!=','admin')->get();
        return view('admin.adminViewAllUsers')->with('users',$users);
    }

    public function adminViewAllUsers(){
        return view('admin.adminViewAllUsers');
    }


    public function editUserByAdmin($id){
        $user = User::find($id);
        // echo $user;
        return view('admin.editUserByAdminView')->with('user',$user);
    }



    public function editUserByAdminPost(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
        ]);
        $user = User::find($request->id);
        $user->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
        ]);

        return redirect()->route('adminViewAllUsers')->with("success","user updated successfully");

    }

    public function deleteUserByAdmin($id){
        $user = User::find($id);
        $user->delete();
        
        return redirect()->route('adminViewAllUsers')->with('sucess',"user deleted successfully");
    }


}
