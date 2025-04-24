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
        'sort_order'
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'show_on_start' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}
