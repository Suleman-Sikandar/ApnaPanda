<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AdminUserModel extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tbl_admin_user_roles';
    public function role()
    {
        return $this->belongsTo(TblRole::class, 'role_id', 'id');
    }
}
