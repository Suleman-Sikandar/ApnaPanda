<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblImage extends Model
{
    protected $table='tbl_images';
    protected $fillable=[
        'product_id',
        'image_path',
    ];

 
    public function product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
