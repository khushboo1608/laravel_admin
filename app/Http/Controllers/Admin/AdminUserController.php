<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAuthMaster;
use Validator;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserDataTable $dataTable)
    {
        $this->middleware('is_admin');
        $this->dataTable = $dataTable;
    }
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            // print_r($data); die;
            return datatables()::of($this->dataTable->all($request))
            ->addIndexColumn()
            ->editColumn('imageurl', function ($data) {
                $profile_image = $this->GetImage($file_name = $data->imageurl,$path=config('global.file_path.user_profile'));
                
                if($profile_image == '')
                {
                    $profile_image = config('global.no_image.no_user');
                }
                return $profile_image;
            })
            ->editColumn('is_verified', function ($data) {
                $checked = ($data['is_verified'] == 1) ? "Yes" : "No";
                return $checked;
            })
            ->addColumn('is_disable', function ($data) {
                $btn1='';
                $checked = ($data['is_disable'] == 1) ? "" : "checked";
                $title =  ($data['is_disable'] == 1) ? "Disable" : "Enable";
                if($data['is_disable'] == 1){
                    // $btn1 = '<button type="button"  class="btn btn-danger btn-sm deletegym" onclick="Status(\''.$data->id.'\','.$data->is_disable.')">'.$title.' </i>
                    // </button>';
                    $btn1 = '<a href="#" style="padding:6px;" class="btn btn btn-danger m-b-10 m-l-5 " onclick="Status(\''.$data->id.'\','.$data->is_disable.')">'.$title.' 
                    </a>';
                }
                else{
                    // $btn1 = '<button type="button"  class="btn btn-success btn-sm deletegym" onclick="Status(\''.$data->id.'\','.$data->is_disable.')" >'.$title.' </i>
                    // </button>';  

                    $btn1 = '<a href="#" style="padding:6px;"  class="btn btn btn-success m-b-10 m-l-5" onclick="Status(\''.$data->id.'\','.$data->is_disable.')" >'.$title.'
                    </a>';
                }
               
                return $btn1;
            })
            ->addColumn('action', function($data){

                $url=route("admin.user");
                $btn = '<a href="'.$url.'/edit/'.$data->id.'" style="color: white !important"><button type="button" class="edit btn btn-primary btn-sm editPost"  title="edit"><i class="fa fa-edit"></i>
                </button></a>&nbsp;&nbsp;<button type="button"  class="btn btn-danger btn-sm deletePost" onclick="DeleteUser(\''.$data->id.'\')" title="edit"><i class="fa fa-trash"></i>
                </button>';
                 return $btn;
         })
            ->rawColumns(['action','is_disable'])
            ->make(true);
        }
        return view('admin.user.index');
    }

    public function change_status(Request $request)
    {
        $user_id = $request->id;

        User::where('id',$user_id)->update(['is_disable' =>$request->is_disable]);

        if($request->is_disable == 1)
        {
            $msg = __('Disable successfully');
            $text = "Disabled";
        }else{
            $msg = __('Enable successfully');
            $text = "Enabled";
        }
        return Response::json(['result' => true,'message'=>$msg,'text'=>$text]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_user()
    {
        //
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveuser(Request $request)
    {
        //

        $userData = $request->all();
        // dd($userData);
        // exit;
        $message="";
        $user_image = "";
        // dd($request->imageurl);
        // exit;
        if($userData['id'] != "")
        {
            $user_data = User::find($userData['id']);
            // dd($user_data);
            // exit;
            if ($request->imageurl != "") {
                
                if ($user_data->imageurl != '') {

                    $this->RemoveImage($user_data->imageurl, config('global.file_path.user_profile'));
                }else{ }
                
                $user_image = $this->UploadImage($file = $request->imageurl, $path = config('global.file_path.user_profile'));
                // echo 'if';
            } else {
                // echo 'else';
                $user_image = $request->imageurl;
            }

            $userData['imageurl'] = $user_image;    
            $user = User::find($userData['id']);
            $user->fill($userData);
            $user->save();
            $message="User Data Updated  Sucessfully";

        }else{
            
            $rules = array('email' => 'unique:users,email','phone'=>'unique:users,phone');

            $messages = [
                'email.unique' => 'User already exist with this email. Try another.',
                'phone.unique' => 'User already exist with this phone. Try another.'
            ];

            $validator = Validator::make($userData,$rules,$messages);

            if(!$validator->fails())
            {   
                if($request->hasFile('imageurl')){
                // if ($request->imageurl != "") {
                    $user_image = $this->UploadImage($file = $request->imageurl, $path = config('global.file_path.user_profile'));
                    // echo 'if';
                } else {
                    // echo 'else';
                    $user_image = $request->imageurl;
                }

                $userData['imageurl']  = $user_image;    
                $userData['login_type'] = 2;
                $userData['password'] = Hash::make($request->password);
                $user_id = $this->GenerateUniqueRandomString($table='users', $column="id", $chars=32);
                $userData['id'] = $user_id;
                // dd($userData);
                // exit;
                $user = User::create($userData);
                $token = $user->createToken(env('APP_NAME'));
                $user->token = $token->accessToken;
                $oauth_access_token_id = $token->token->id;
                $user_auth_id = $this->GenerateUniqueRandomString($table='user_auth_master', $column="user_auth_id", $chars=32);
                
                $auth_input = array(
                    'user_auth_id' => $user_auth_id,
                    'user_id' => $user->id,
                    'oauth_access_token_id' => $oauth_access_token_id,
                    'device_type' => 3,
                    'device_token' => 'devicetoken'
                );
                $user_auth_token = UserAuthMaster::create($auth_input);
                
                $message="User Insert Sucessfully";

            }else{ 
                $error = $validator->errors()->first();
                return redirect()->back()->with('error',$error);

            }

        }
            // $userData['password'] = Hash::make($request->password);
            Session::flash('message',$message);
            return redirect('admin/user');
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_data_edit($id)
    {
        //
        $data=User::where('id',$id)->first();
        // dd($data);
        // exit;
        $data->profile_image = $this->GetImage($file_name = $data->profile_image,$path=config('global.file_path.user_profile'));

        // echo "<pre>";
        // print_r($data); die;
        return view('admin.user.edit')->with(['UserData' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_delete(Request $request)
    {
        // 
        $user_id = $request->id;
        $delete = User::find($user_id);
        $delete ->delete();
        // $message="User Deleted Sucessfully";
        // Session::flash('message',$message);
        // return view('admin/user');
        return Response::json(['result' => true,'message'=> 'User deleted..!']);
    }
}
