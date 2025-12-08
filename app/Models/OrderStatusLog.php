<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $table = 'tbl_order_status_logs';

    public $timestamps = false; // We only have created_at as per schema, handled by DB or manually. But usually Laravel expects both. Schema had `created_at` timestamp. I'll set timestamps to false and handling created_at in migration `useCurrent`.

    protected $fillable = [
        'order_id',
        'old_status',
        'status_changed_to',
        'user_type',
        'user_id',
        'notes',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(TblOrder::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(TblAdmin::class, 'user_id');
    }
}
