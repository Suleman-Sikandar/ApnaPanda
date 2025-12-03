<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TblAdmin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_admin';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(TblRole::class, 'tbl_admin_user_roles', 'user_ID', 'role_ID');
    }
}
