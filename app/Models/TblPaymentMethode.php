<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblPaymentMethode extends Model
{
    protected $fillable = [
        'display_order',
        'icon',
        'payment_methode',
    ];
}
