<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblBusiness extends Model
{
    protected $fillable = [
        'name',
        'display_order'
    ];
}
