<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\UserAuthMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm()
    {
        // echo "hi";exit();
       if(Auth::user())
       {
            return view('auth.admin.login');
       }
       else
       {
            return view('auth.admin.login');
       }
        
    }

    public function login(Request $request)
    {   
        // echo '<pre>'; 
        $input = $request->all();
        // print_r($input); die;
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            
            if (Auth::user()->login_type == 1) {
                
                // echo 'sdf';exit;
                return redirect('admin/home');
            }else{
                //  echo 'sdf';exit;
                return redirect('/admin')->withInput()->with('message', 'Admin could not found with this credential.');
            }
        }else{
            return back()->withInput()->with('message', 'Invalid email or password.');
        }
          
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
	    return redirect('admin');
    }



}
