<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblRole extends Model
{
    protected $table = 'tbl_roles';

    protected $fillable = [
        'name',
        'display_order',
    ];

    public function admins()
    {
        return $this->belongsToMany(TblAdmin::class,'tbl_admin_user_roles','role_ID','admin_ID');
    }

    public function modules()
    {
        return $this->belongsToMany(TblModule::class,'tbl_role_privillege','role_id','module_id');
    }
}
