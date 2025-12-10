<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblRiderModel extends Model
{
    protected $table = 'tbl_riders';

    protected $fillable = [
        'user_id',
        'phone',
        'alternative_phone',
        'vehicle_type',
        'vehicle_number',
        'license_number',
        'license_expiry',
        'national_id_number',
        'profile_photo',
        'license_front',
        'license_back',
        'national_id_front',
        'national_id_back',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'current_step',
        'is_face_verified',
        'status',
        'approved_by_admin_id',
        'status_updated_at',
        'rejection_reason',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

