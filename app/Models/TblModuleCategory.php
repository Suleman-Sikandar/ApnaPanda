<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblModuleCategory extends Model
{
    protected $table= 'tbl_module_categories';
    protected $fillable=[
        'name',
        'display_order',
        'is_active',
    ];

    public function modules()
    {
        return $this->hasMany(TblModule::class, 'module_category_id');
    }
}
