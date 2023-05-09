<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * [index fetch Users to admin]
     * @return [Array] [Returns list of Users]
     */
    public function index(Request $request)
    {
        // $users = User::all();
        $users = User::where('role', 'user')->paginate(5);


        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $users = User::where('role', 'user');

            $users =   $users->where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);

            return view('backend.user.table', compact('users'));
        }
        return view('backend.user.index', ['users' => $users]);
    }

    /**
     * [create GET createPage of User]
     * @return [View] [Returns CreatePage of User]
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * [store POST saveUser]
     * @return [View] [Returns Send email and password to User email]
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $gpassword = bin2hex(openssl_random_pseudo_bytes(4));
        $data['password'] =  Hash::make($gpassword);
        $user = User::create($data);
        $user->gpassword = $gpassword;
        $user->notify(new NewUser("A new user has visited on your application."));
        if ($user) {
            return redirect()->route('user.index')->with(['message' => 'User Created Successfully']);
        } else {
            return redirect()->route('user.index')->with('error', 'Can`t Create User Now ');
        }
    }


    /**
     * [update GET updatePage of User]
     * @return [View] [Returns CreatePage of User]
     */
    public function update($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('backend.user.update', ['user' => $user]);
        }
        return redirect()->route('dashboard')->with('error', 'something went wrong');
    }

    /**
     * [edit PUT  updateUser]
     * @return [View] [Returns Send email and password to User email]
     */
    public function edit(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', "Can't find a User");
        }
        $result  = $user->update($data);
        if ($result) {

            if (auth()->user()->role == 'admin') {
                return redirect()->route('user.index')->with(['message' => 'User Updated Successfully']);
            }
            return redirect()->route('dashboard')->with(['message' => 'User Updated Successfully']);
        } else {

            if (auth()->user()->role == 'admin') {
                return redirect()->route('user.index')->with(['error' => "Can't update user"]);
            }
            return redirect()->route('dashboard')->with(['error' => "Can't update user"]);
        }
    }


    /**
     * [destroy DELETE  delete user]
     * @return [JSON] [Returns Redirect to Allusers]
     */
    public function destroy(Request $request, $id)
    {
        try {
            if (auth()->user()->role  !== 'admin') {
                return redirect()->route('dashboard')->with('error', 'something went wrong');
            }
            $user = User::find($id);

            deleteOneImage("profile-images", $user->profile_image);

            $deleted = $user->delete();
            if ($deleted) {
                if ($request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'User Deleted Successfully !!']);
                }
                return redirect()->route('user.all')->with('message', 'User Deleted Successfully');
            }

            return redirect()->route('user.all')->with('error', 'User Delete Failed');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'something went wrong');
            // throw $th;
        }
    }

    /**
     * [profile GET userProfilePage of User]
     * @return [View] [Returns profile of User]
     */
    public function profile()
    {
        $user =  auth()->user();
        return view('backend.user.profile', ['user' => $user]);
    }


    /**
     * [status PATCH  update user Status]
     * @return [JSON] [Returns Redirect to All suer]
     */
    public function status(Request $request,  $id)
    {
        $model = User::find($id);
        if ($model->role == 'user') {
            $model->status == '1' ? $model->status = '0' : $model->status = '1';
            $model->save();
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Done !!']);
            }
        } else {
            return response()->json(['success' => false, 'message' => "Error !!"]);
        }
    }


    /**
     * [changePassword GET chanagePasswordPage of User]
     * @return [View] [Returns chanagePasswordPage of User]
     */
    public function changePassword()
    {
        return view('auth.change-password');
    }


    /**
     * [updatePassword PUT  updateUser]
     * @return [View] [Returns UpdatePassword]
     */
    public function updatePassword(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    'old_password' => 'required|min:8',
                    'confirm_password' => 'required|same:password|min:8'
                ]
            );
            if (Hash::check($request->input('old_password'), Auth::user()->password)) {
                User::where('id', $id)->update(['password' =>  Hash::make($request['password'])]);
                return redirect()->route('dashboard')->with(['message' => 'Password updated Successfully']);
            } else {
                return Redirect::back()->withErrors(['msg' => "Password is wrong"]);
            }
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'something went wrong');
            // throw $th;
        }
    }


    public function profilePic(Request $request, $id)
    {
        //patch
        $data = $request->all();
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', "Can't find a User");
        }

        $file_name =  saveProfilePic($user, $data['image']);

        if ($user->profile_image) {
            deleteOneImage("profile-images", $user->profile_image);
        }

        if ($file_name) {
            $user->profile_image = $file_name;
            $user->save();
            $image_url = asset('profile-images/' . $file_name);
            if ($request->ajax()) {
                return response()->json(['data' => $image_url, 'success' => true, 'message' => 'Profile Pic Updated successfully !!']);
            }
        }
        return response()->json(['data' => $image_url, 'success' => false, 'message' => "Profile Pic Can't Updated !!"]);
    }



    public function deleteProfilePic(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('dashboard')->with('error', "Can't find a User");
        }

        if ($user->profile_image) {
            deleteOneImage("profile-images", $user->profile_image);
            $user->profile_image = '';
            $result = $user->save();

            if ($result) {
                return redirect()->back()->with('success', 'Profile Pic Deleted successfully!!');
            }
            return redirect()->back()->with('error', "Can't Delete a User profile picture");
        }
    }
}
