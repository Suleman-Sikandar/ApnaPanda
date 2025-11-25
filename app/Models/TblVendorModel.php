<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblVendorModel extends Model
{
    protected $table = 'tbl_vendors';
 
    protected $fillable = [
        'user_id',
        'alternative_phone',
        'business_name',
        'business_type',
        'category',
        'business_registration_number',
        'GST_number',
        'PAN_number',
        'business_email',
        'business_phone',
        'establishment_year',
        'website_url',
        'description',
        'logo',
        'cnic_front',
        'cnic_back',
        'registration_certificate',
        'GST_certificate',
        'PAN_card',
        'shop_image',
        'account_holder_name',
        'account_number',
        'bank_name',
        'IFSC_code',
        'branch_name',
        'account_type',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'current_step',
        'is_face_verified',
    ];
}
