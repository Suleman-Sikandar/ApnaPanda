<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblProductCategory extends Model
{
    protected $table='tbl_product_categories';
    protected $fillable=[
        'category_name'
    ];
}
