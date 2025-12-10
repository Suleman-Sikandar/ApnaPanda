<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblProduct extends Model
{
    protected $table='tbl_products';
    protected $fillable=[
        'name',
        'vendor_id',
        'category_id',
        'price',
        'status',
        'stock_quantity',
        'SKU',
        'description',
        'discount_percent',
        'discount_amount',
        'has_free_delivery',
        'delivery_charge',
        'rating',
        'review_count',
    ];
    public function vendor()
    {
        return $this->belongsTo(TblVendorModel::class);
    }
    public function category()
    {
        return $this->belongsTo(TblProductCategory::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(TblImage::class, 'product_id');
    }
}   
