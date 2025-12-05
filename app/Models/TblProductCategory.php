<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblProductCategory extends Model
{
    protected $table='tbl_product_categories';
    protected $fillable=[
        'category_name'
    ];

    public function products()
    {
        return $this->hasMany(TblProduct::class, 'category_id');
    }
}
