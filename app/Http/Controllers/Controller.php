<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\User;
use DateTime;
use File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function UploadImage($file,$path)
    {
        // echo "<pre>";
        // print_r($file);die;
        if($file)
        {  
            $fname = $file->getClientOriginalName();
            $image_name = time().'_'.$fname;
           
                $local_path = public_path($path);
                $file->move($local_path, $image_name);
                return $image_name;                
        }
        else
        {
            return '';
        }
    }

    public function RemoveImage($name,$path)
    {
        
        $file = $path.'/'.$name;
        // dd($path);
        // exit;
        // dd(count(File::allFiles($path)));

        $directory = public_path($path);
        if (File::exists($directory) && File::isDirectory($directory)) {
            // Get the total number of files in the directory
            $fileCount = count(File::allFiles($directory));
            // return $fileCount;
        } else {
            // Directory does not exist or is not a directory
            return 0;
        }
        // dd($fileCount);
        // exit;
        if($fileCount > 0)
        {
            unlink(public_path() . '/' . $file);
        }else{

        }
        // dd($fileCount);
        // exit;
        // $path = public_path().'/'.$file;
        // dd($file);
        // unlink($path);
        // $exists = Storage::disk('public')->exists('images/admin/user_profile/1700567193_006.png');
        
        
        
        
        // exit;
       
        
    }

   

    public function GetImage($file_name,$path)
    {
        // echo $path; die;
        if($file_name != '')
        {
            if(file_exists(public_path($path.'/'.$file_name)))
			{
                // echo "in"; die;
				return url('public').'/'.$path.'/'.$file_name; 
			}
			else
			{
                // echo 'else'; die;
				return '';
				
			}
        }
        else
        {
            return '';
        }
    }


    public static function GenerateUniqueRandomString($table, $column, $chars)
    {
        $unique = false;
        do{
            $randomStr = Str::random($chars);
            $match = DB::table($table)->where($column, $randomStr)->first();
            if($match)
            {
                continue;
            }
            $unique = true;
        }
        while(!$unique);
        return $randomStr;
    }

    //reffer code
    public function generateReferralCode()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (User::where("referral_code", "=", $code)->first());
  
        return $code;
    }

}
