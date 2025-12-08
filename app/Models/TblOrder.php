<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TblVendorModel;
use App\Models\TblPaymentMethode;

class TblOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'vendor_id',
        'order_status',
        'payment_amount',
        'payment_method_id',
        'delivery_address',
        'latitude',
        'longitude',
        'city',
        'province',
        'country',
        'postal_code',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function vendor()
    {
        return $this->belongsTo(TblVendorModel::class, 'vendor_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(TblPaymentMethode::class, 'payment_method_id');
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class, 'order_id')->orderBy('created_at', 'desc');
    }

    public function orderItems()
    {
        return $this->hasMany(TblOrderItem::class, 'order_id');
    }
}
