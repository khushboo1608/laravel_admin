<?php 
namespace App\DataTables;
use App\Models\Vendor;
use DB;

class VendorDataTable{
    public function all(){
        $data = Vendor::orderby('created_at','desc')->get();
        return $data;
    }   
}

?>