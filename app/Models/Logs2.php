<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs2 extends Model
{
    /** @use HasFactory<\Database\Factories\Logs2Factory> */
    use HasFactory;

    protected $fillable = [
        'comment',
//        'added_at',
        'type',
        'reminder_at',
        'user_id',
        'leed_record_id',
        'user_id', 'order_id', 'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function leedRecord()
    {
        return $this->belongsTo(LeedRecord::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
