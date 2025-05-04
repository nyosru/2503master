<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeedNotification extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'leed_id',
        'message',

        'once_at',

        'weekly_day',
        'weekly_time',

        'monthly_day',
        'monthly_time',

        'yearly_day',
        'yearly_month',
        'yearly_time',

//        'telegram_id',

        'user_id',

    ];

    protected $dates = [
        'once_at',
        'weekly_time',
        'monthly_time',
        'yearly_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    protected $casts = [
//        'once_at',
//        'weekly_time',
//        'monthly_time',
//        'yearly_time',
//        'created_at',
//        'updated_at',
//        'deleted_at',
//    ];

    public function leed()
    {
        return $this->belongsTo(LeedRecord::class, 'leed_id');
    }

//    public function telegramUser()
//    {
//        return $this->belongsTo(TelegramUser::class, 'telegram_id');
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
