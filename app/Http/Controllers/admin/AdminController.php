<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\User;

// models
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// middleware

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('userRole:3');
    }

    // return admin dashboared view
    public function adminDashboard()
    {
        return view('admin.adminDashboard');
    }

    // return admin upload image view
    public function adminUploadImage()
    {
        return view('admin.adminUploadImage');
    }

    // store the image uplod by the admin
    public function adminUploadImagePost(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required',
            ]);

            if ($request->hasFile('image')) {

                $image = $request->file("image");

                $user = Auth::id();
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $fileToStore = $fileName . "_" . time() . "." . $fileExt;

                if ($request->file('image')->storeAs('public/images', $fileToStore)) {
                    // echo "ok";
                    images::create([
                        'uploaderId' => $user,
                        'imagePath' => $fileToStore,
                    ]);
                    return redirect()->route('adminUploadImage')->withSuccess("Uploaded image succesfully");
                } else {
                    return redirect()->route('adminUploadImage')->withSuccess("Uploaded image not succesfully");
                }
            }
        } catch (Exception $e) {
            return redirect()->route("adminUploadImage")->withError($e->getMessage());
        }
    }

    // return all users view with All users data with role
    public function adminViewAllUsersGet()
    {
        $users = User::where('username', '!=', 'admin')->with('roles')->get();
        return view('admin.adminViewAllUsers')->with('users', $users);
    }

    // return adminViewAllUsers page
    public function adminViewAllUsers()
    {
        return view('admin.adminViewAllUsers');
    }

    // edit user by admin view with  the selected id
    public function editUserByAdmin($id)
    {
        $user = User::find($id);
        return view('admin.editUserByAdminView')->with('user', $user);
    }

    // update the user data after submit the form by the admin
    public function editUserByAdminPost(Request $request)
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

        return redirect()->route('adminViewAllUsers')->with("success", "user updated successfully");

    }

    // delete user by the admin
    public function deleteUserByAdmin($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('adminViewAllUsers')->with('sucess', "user deleted successfully");
    }

    // update the role of the user
    public function updateRole(Request $request)
    {

        $user = User::find($request->input("userId"));

        $roleId = $request->input('roles');

        $user->roles()->syncWithPivotValues($roleId, ['created_at' => now()]);

        return redirect('adminViewAllUsers');
    }

}
