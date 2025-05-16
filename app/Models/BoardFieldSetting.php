<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardFieldSetting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'board_id',
        'field_name',
        'is_enabled',
        'show_on_start',
        'in_telega_msg',
        'sort_order'
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'show_on_start' => 'boolean',
        'in_telega_msg' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function orderRequest(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OrderRequest::class, 'pole', 'field_name');
    }


}
