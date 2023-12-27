<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\DataTables\VendorDataTable;
use Response;
use Validator;

class AdminVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(VendorDataTable $dataTable)
    {
        $this->middleware('is_admin');
        $this->dataTable = $dataTable;
    }
    public function index(Request $request)
    {
        // echo "innn";die;
        if ($request->ajax()) {
           
            return datatables()::of($this->dataTable->all($request))
            ->addIndexColumn()  
            ->editColumn('vendot_icon', function ($data){
                // echo "<pre>";
                // print_r($data->vendor_icon);die;
                 $vendor_icon = $this->GetImage($file_name = $data->vendor_icon, $path=config('global.file_path.vendor_image'));
             
                if($vendor_icon == '')
                {
                    // echo 'if';die;
                    $vendor_icon = config('global.no_image.no_image');
                }
                return $vendor_icon;
            })
            ->addColumn('vendor_feature', function($data){
                $btn1='';
                $checked = ($data['vendor_feature'] == 1) ? "" : "checked";
                $title = ($data['vendor_feature'] == 1) ? "No" : "Yes";

                if($data['vendor_feature'] ==1){
                    $btn1 = '<a href="#" style="padding:6px;" class="btn btn btn-danger m-b-10 m-l-5 " onclick="Feature(\''.$data->vendor_id.'\','.$data->vendor_feature.')">'.$title.' 
                    </a>';
                }else{
                    $btn1 = '<a href="#" style="padding:6px;"  class="btn btn btn-success m-b-10 m-l-5" onclick="Feature(\''.$data->vendor_id.'\','.$data->vendor_feature.')" >'.$title.'
                    </a>';
                }
                return $btn1;
            })        
            ->addColumn('vendor_status', function($data){
                $btn2='';
                $checked1 = ($data['vendor_status'] == 1) ? "" : "checked";
                $title1 = ($data['vendor_status'] == 1) ? "Active" : "Deactive";

                if($data['vendor_status'] ==1){
                    $btn2 = '<a href="#" style="padding:6px;" class="btn btn btn-success m-b-10 m-l-5 " onclick="Status(\''.$data->vendor_id.'\','.$data->vendor_status.')">'.$title1.' 
                    </a>';
                }else{
                    $btn2 = '<a href="#" style="padding:6px;"  class="btn btn btn-danger m-b-10 m-l-5" onclick="Status(\''.$data->vendor_id.'\','.$data->vendor_status.')" >'.$title1.'
                    </a>';
                }
                return $btn2;
            })          
            ->addColumn('action', function($data){

                $url=route("admin.vendor");
                $btn = '<a href="'.$url.'/edit/'.$data->id.'" style="color: white !important"><button type="button" class="edit btn btn-primary btn-sm editPost"  title="edit"><i class="fa fa-edit"></i>
                </button></a>&nbsp;&nbsp;<button type="button"  class="btn btn-danger btn-sm deletePost" onclick="DeleteUser(\''.$data->vendor_id.'\')" title="edit"><i class="fa fa-trash"></i>
                </button>';
                 return $btn;
         })
            ->rawColumns(['action','vendor_status','vendor_feature'])
            ->make(true);
        }
        
        return view('admin.vendor.index');
    }

    public function feature_vendor(Request $request)
    {   
        // dd($request->id);
        $vendor = $request->id;
        Vendor::where('vendor_id', $vendor)->update(['vendor_feature' => $request->vendor_feature]);

        if($request->vendor_feature == 1){
            $msg = __('Disable successfully');
            $text = "Disabled";
        }else{
            $msg = __('Enable successfully');
            $text = "Enabled";
        }

        return Response::json(['result' => true, 'message' => $msg,'text' => $text]);
        
    }

    public function status_vendor(Request $request)
    {
        $vendor = $request->id;
        // dd($request->id);
        // exit;
        $vend = Vendor::where('vendor_id', $vendor)->update(['vendor_status' => $request->vendor_status]);
        // dd($vend);
        // exit;
        if($request->vendor_status ==1){
            $msg = __("Enable successfully");
            $text = "Enabled";
           
        }else{
            $msg = __("Disable successfully");
            $text = "Disabled";
        }
        return Response::json(['result' => true,'message' => $msg, 'text' => $text]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_vendor(Request $request)
    {
        //
        // echo 'hello';
        // exit;
        return view('admin.vendor.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savevendor(Request $request)
    {
        //
        $input = $request->all();
        // dd($input);
        // exit;
        $message="";
        $vendor_icon="";
        $vendor_banner="";
        $vendor_gallery=[];
        if($input['vendor_id'] != ""){
            $vendor = Vendor::where(['vendor_id' => $input['vendor_id']])->first();

            $rules = [
                'vendor_email' => 'unique:vendors,vendor_email,'.$input['vendor_id'].',vendor_id',
                'vendor_phone' => 'unique:vendors,vendor_phone,'.$input['vendor_id'].',vendor_id',
            ];

            $messages = [
                'vendor_email.unique' => 'Vendor already exist with email. Try another.',
                'vendor_phone.unique' => 'Vendor already exist with phone. Try another.',
            ];

            $validator = Validator::make($input, $rules, $messages);

            if($validator -> fails()){
                $errors = $validator->errors()->first();
                return redirect()->back()->with('error',$errors);
            }else{

                if ($request->vendor_icon != "") {
                
                    if ($vendor->vendor_icon != '') {
    
                        $this->RemoveImage($vendor->vendor_icon, config('global.file_path.vendor_image'));
                    }else{ }
                    
                    $vendor_icon = $this->UploadImage($file = $request->vendor_icon, $path = config('global.file_path.vendor_image'));
                    // echo 'if';
                } else {
                    // echo 'else';
                    $vendor_icon = $request->vendor_icon;
                }

                // if($request->vendor_icon != ""){
                //     $vendor_icon = $this->UploadImage($file = $request->vendor_icon, $path = config('global.file_path.vendor_image'));
                // }else{
                //     $vendor_icon = $request->vendor_icon;
                // }
                if ($request->vendor_banner != "") {
                
                    if ($vendor->vendor_banner != '') {
    
                        $this->RemoveImage($vendor->vendor_banner, config('global.file_path.vendor_image'));
                    }else{ }
                    
                    $vendor_banner = $this->UploadImage($file = $request->vendor_banner, $path = config('global.file_path.vendor_image'));
                    // echo 'if';
                } else {
                    // echo 'else';
                    $vendor_banner = $request->vendor_banner;
                }

                // if($request->vendor_banner != ""){
                //     $vendor_banner = $this->UploadImage($file = $request->vendor_banner, $path = config('global.file_path.vendor_image'));
                // }else{
                //     $vendor_banner = $request->vendor_banner;
                // }
    
                if(isset($request->vendor_gallery)){
                    if($request->vendor_gallery != ""){
                        foreach($input['vendor_gallery'] as $key => $value){
                            //REMOVE gallery image pending
                            $vendor_gallery[] = $this->UploadImage($file = $request->vendor_gallery, $path = config('global.file_path.vendor_image'));
                        }
                        // echo '<pre>';
                        // print_r($vendor_gallery); exit;
                        $gallery = impload(',', $vendor_gallery); 
                    }else{
                        $gallery = $request->vendor_gallery;
                    }
                }else{
                    $gallery = "";
                }

                $arr2 = explode(",",$gallery);
                if($request->vendor_gallery != ""){
                    $arr1 = explode(",",$request->vendor_gallery);
                }else{
                    $arr1= [];
                }
                $arr2 = array_filter($arr2, 'strlen');
                if(count($arr1)>0){
                    $newarray = array_merge($arr1, $arr2);
                    $newarray1 = implode(',', $newarray);
                }else{
                    $newarray1 = implode(',', $arr2);
                }
                $input['vendor_gallery'] = $newarray1;
                $input['vendor_icon'] = $vendor_icon;
                $input['vendor_banner'] = $vendor_banner;
                if($request->vendor_password != ''){
                    $input['vendor_password'] = Hash::make($request->vendor_password);
                }else{
                    $input['vendor_password'] = $vendor->vendor_password;
                }

                $vendors = Vendor::find($input['vendor_id']);
                $vendors->fill($vendors);
                $vendors->save();
                $message = "Vendor Data Updated Sucessfully";
            }


            }else{

                $rules = array('vendor_email' => 'unique:vendors,vendor_email','vendor_phone' => 'unique:vendors,vendor_phone');

                $messages = [
                    'vendor_email.unique' => 'Vendor already extist with this email. Try another.',
                    'vendor_phone.unique' => 'Vendor already extist with this phone. Try another.'
                ];

                $validator = Validator::make($input, $rules, $messages);

                if(!$validator->fails()){
                  
                    if($request->hasFile('vendor_icon')){
                        // if ($request->imageurl != "") {
                        $vendor_icon = $this->UploadImage($file = $request->vendor_icon, $path = config('global.file_path.vendor_image'));
                            // echo 'if';
                    } else {
                        // echo 'else';
                        $vendor_icon = $request->vendor_icon;
                    }

                    if($request->hasFile('vendor_banner')){
                        // if ($request->imageurl != "") {
                        $vendor_banner = $this->UploadImage($file = $request->vendor_banner, $path = config('global.file_path.vendor_image'));
                            // echo 'if';
                    } else {
                        // echo 'else';
                        $vendor_banner = $request->vendor_banner;
                    }

                    if($request->hasFile('vendor_gallery')){
                        foreach($request->vendor_gallery as $key => $value){
                            $vendor_gallery[] = $this->UploadImage($file = $value,$path = config('global.file_path.vendor_image'));
                        }
                        echo '<pre>';
                        print_r($vendor_gallery); exit;
                        $gallery = impload(',',$vendor_gallery);
                        
                    } else {
                        // echo 'else';
                        $gallery = $request->vendor_gallery;
                    }

                    $input['vendor_icon'] = $vendor_icon;
                    $input['vendor_banner'] = $vendor_banner;
                    $input['vendor_gallery'] = $gallery;
                    $input['vendor_feature'] = 0;
                    $input['vendor_id'] = $this->GenerateUniqueRandomString($table = 'vendors', $column='vendor_id', $chars=32);
                    $input['vendor_password'] = Hash::make($request->vendor->password);
                    $vendor = Vendor::create($input);
                    $message = "Vendor Insert Sucessfully";

                }else{
                    $errors = $validator->errors()->first();
                    return redirect()->back()->with('error', $errors);
                }

                Session::flash('message',$message);
                return redirect('admin/vendor');

            }

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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
