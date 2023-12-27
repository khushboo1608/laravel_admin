<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    public $table = "vendors";
    protected $primaryKey = 'vendor_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'vendor_id',
        'vendor_name', 
        'vendor_desc',
        'vendor_icon',
        'vendor_banner',
        'vendor_gallery', 
        'vendor_phone', 
        'vendor_email', 
        'vendor_password', 
        'vendor_lat', 
        'vendor_long', 
        'vendor_postal_code', 
        'vendor_adderss', 
        'vendor_distance', 
        'vendor_token', 
        'vendor_feature', 
        'vendor_status' 
    ];
}
