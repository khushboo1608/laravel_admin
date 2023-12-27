<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Response;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('is_admin');
    }
    
    public function index()
    {
        //
        $data = Settings::where('is_disable',0)->first();
        return view('admin.setting.index')->with(['SettingsData' => $data]);
        
    }

    public function GeneralSetting()
    {
        $data = Settings::Where('is_disable',0)->first();
        return view('admin.setting.general')->with(['SettingsData' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SavePageSetting(Request $request)
    {
        //
        $settingData = $request->all();
        $message = '';

        if($settingData['id'] != '')
        {
            $setting = Settings::find($settingData['id']);
            $setting->fill($settingData);
            $setting->save();
        }else{
            Settings::create($settingData);
            // $message="Data Insert Successfully";
        }
        return redirect('admin/setting')->with(['setting-add' =>__('messages.admin.setting.update_success')]);
        // return redirect('admin/setting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function SaveGeneral(Request $request)
    {
        //
        $settingData = $request->all();
        // dd($settingData);
        // exit;
        $message="";
        $app_logo="";
        $app_api_image="";

        if($settingData['id'] != '')
        {
            if(!isset($settingData['app_maintenance_status'])){
                $settingData['app_maintenance_status'] = 2;
            }

            if(!isset($settingData['app_update_cancel_button'])){
                $settingData['app_update_cancel_button'] = 2;
            }

            if(!isset($settingData['app_update_factor_button'])){
                $settingData['app_update_factor_button'] = 2;
            }

            // dd($request->app_logo_edit);
            // exit;

            if ($request->app_logo != "") {
                
                if ($request->app_logo_edit != '') {

                    $this->RemoveImage($request->app_logo_edit, config('global.file_path.app_logo'));
                }else{ }
                
                $app_logo = $this->UploadImage($file = $request->app_logo, $path = config('global.file_path.app_logo'));
                // echo 'if';
            } else {
                // echo 'else';
                $app_logo = $request->app_logo_edit;
            }
            
            // dd($app_logo);
            // exit;
            $settingData['app_logo'] = $app_logo;

            if ($request->app_upi_image != "") {
                // Handling app_upi_image
                if ($request->app_upi_image_edit != '') {
                    $this->RemoveImage($request->app_upi_image_edit, config('global.file_path.app_upi_image'));
                }else{}  

                $app_upi_image = $this->UploadImage($file = $request->app_upi_image, $path = config('global.file_path.app_upi_image'));
            } else {
                $app_upi_image = $request->app_upi_image_edit;
                
            }

            $settingData['app_upi_image'] = $app_upi_image;

            // dd($request->app_upi_image);
            // exit;
        

            $setting = Settings::find($settingData['id']);
            $setting->fill($settingData);
            $setting->save();
            
        }

        return redirect('admin/generalsetting')->with(['setting-add' =>__('messages.admin.setting.update_success')]);
        

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
