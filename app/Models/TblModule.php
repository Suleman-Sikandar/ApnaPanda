<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblModule extends Model
{
    protected $table    = 'tbl_modules';
    protected $fillable = [
        'module_category_id',
        'module_name',
        'route',
        'show_in_menu',
        'icon_class',
        'display_order',
        'is_active',
    ];
    
    public function category()
    {
        return $this->belongsTo(TblModuleCategory::class, 'module_category_id');
    }

}
