<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class AdminHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
       
        // return view('home')->with(['user_count' => $user_count]); 
        $user_count = User::where('login_type','!=',1)->count();
        
        return view('admin/home',compact('user_count'));
        // return view('admin/home');
    }

    public function profile(Request $request)
    {
        $auth_user = auth()->user();
        $admin = $auth_user;
        return view('admin.admin-user.profile',compact('admin'));
    }


    public function update_profile(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
        $auth_user = auth()->user();
       
        $admin = $auth_user;
        if ($auth_user->imageurl != '') {
        
            $this->RemoveImage($auth_user->imageurl, config('global.file_path.admin_user_profile'));

        }
       
        $profile_image ='';
        if($request->imageurl != "")
        {   
            $profile_image = $this->UploadImage($file = $request->imageurl,$path = config('global.file_path.admin_user_profile'));
        }
        else{
            if($auth_user->profile_image !=''){
                $profile_image =$auth_user->profile_image;
            }
        }
        // print_r($profile_image);
        // exit;
        $userData['imageurl'] = $profile_image;
        $user = User::find($auth_user->id);
        $user->fill($userData);
        $user->save();
        return redirect('admin/profile')->with(['profile-update' =>__('messages.admin.user.update_profile_success')]);
    }

    public function check_old_password(Request $request)
    {
        $auth_user = auth()->user();
        $admin = $auth_user;
        $flag = "false";
        if (\Hash::check($request->old_password, $admin->password) == true)
        {
            $flag = "true";
        }
        return $flag;
    }

    public function change_password(Request $request)
    {
        $input = $request->all();
        $auth_user = auth()->user();
                
        if($auth_user!='')
        {
            if($input['new_password'] != $input['old_password'])
            {  
                if($input['new_password'] == $input['confirm_password'])
                {  
                    $password  = Hash::make($input['new_password']);
                    User::where('id',$auth_user->id)->update(['password' => $password]);
                    return redirect('admin/profile')->with(['profile-update' =>__('messages.admin.user.update_password_success')]);
                }
                else
                {
                    return back()->withInput()->with('profile-error', 'messages.admin.user.confirm_new_password_not_match');
                }
            }
            else
            {
                return back()->withInput()->with('profile-error', 'messages.admin.user.password_should_different');
            }
        }   
        else
        {
            return $this->sendError(__('messages.api.user.user_not_found'), config('global.null_object'),404,false);
        }
    }
}
