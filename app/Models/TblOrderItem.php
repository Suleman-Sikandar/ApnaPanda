<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TblOrder;
use App\Models\TblProductCategory;
use App\Models\TblProduct;

class TblOrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_category_id',
        'product_id',
        'unit_price',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(TblOrder::class, 'order_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(TblProductCategory::class, 'product_category_id');
    }

    public function product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
