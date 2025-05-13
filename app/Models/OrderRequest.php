<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'pole',
        'description',
        'number',
        'date',
        'text',
        'string',
        'nullable',
        'rules',
    ];

    public function boardFieldSetting(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BoardFieldSetting::class, 'pole', 'field_name');
    }

    
}
