<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblCart extends Model
{
    

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
