<?php

namespace App\Helper;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Settings;

class Helper 
{
	//global function this fun is anywhere page
	public static function LoggedUserImage()
	{
		$auth_user = auth()->user();
		$data = $auth_user->toArray();

		// echo "<pre>";
		// print_r($data);die;
		if(isset($data['imageurl']))
		{
			if(file_exists(public_path(config('global.file_path.admin_user_profile').'/'.$data['imageurl'])))
			{
				$Image = url('public/'.config('global.file_path.admin_user_profile')).'/'.$data['imageurl'];
			}
			else
			{	
				$Image = config('global.no_image.no_user');
			}
		}
		else
		{
			$Image = config('global.no_image.no_user');
		}
		return $Image;
	}

	public static function AppLogoImage()
	{
		$setting =  Settings::first();
		if(isset($setting->app_logo))
		{
			if(file_exists(public_path(config('global.file_path.app_logo').'/'.$setting->app_logo)))
			{
				$Image = url('public/'.config('global.file_path.app_logo')).'/'.$setting->app_logo;
			}
			else
			{	
				$Image = config('global.no_image.no_image');
			}
		}
		else
		{
			$Image = config('global.no_image.no_image');
		}
		return $Image;
	}

	public static function AppName()
	{
		$setting =  Settings::first();
		if(isset($setting->app_name))
		{
			if($setting->app_name !='')
			{
				$Name = $setting->app_name;
			}
			else
			{	
				$Name = env('APP_NAME');
			}
		}
		else
		{
			$Name = env('APP_NAME');
		}
		return $Name;
	}

	public static function AppMapKey()
	{
		$setting =  Settings::first();
		if(isset($setting->map_api_key))
		{
			if($setting->map_api_key !='')
			{
				$map_key = $setting->map_api_key;
			}
			else
			{	
				$map_key = env('APP_MAP_KEY');
			}
		}
		else
		{
			$map_key = env('APP_MAP_KEY');
		}
		return $map_key;
	}

}
?>