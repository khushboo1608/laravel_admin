<?php 
namespace App\DataTables;
use App\Models\User;
use DB;
class UserDataTable
{
    public function all()
    {
        $data = User::Where('login_type','!=',1)->orderby('created_at','desc')->get();
        return $data;
    }
}
?>