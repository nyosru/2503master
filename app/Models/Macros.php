<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Macros extends Model
{
    use SoftDeletes;

    protected $fillable = [
//        'column_id',
        'leed_id',
        'name',
        'comment',
        'type_id',
        'to_telegrams',
        'message',
        'day',
        'move_to_column',
        'status',
    ];

    // Связь с колонкой
//    public function column(): BelongsTo
//    {
//        return $this->belongsTo(LeedColumn::class, 'column_id');
//    }

    public function columns()
    {
        return $this->belongsToMany(
            LeedColumn::class,
            'macro_column', // Имя pivot-таблицы
            'macro_id',     // FK в pivot для Macros
            'column_id'     // FK в pivot для LeedColumn
        );
    }

    // Связь с лидом
    public function leed(): BelongsTo
    {
        return $this->belongsTo(LeedRecord::class, 'leed_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'macro_role', 'macro_id', 'role_id');
    }

    public function moveToColumnData()
    {
        return $this->belongsTo(LeedColumn::class, 'move_to_column');
    }

    public function macroType()
    {
        return $this->belongsTo(MacroType::class, 'type_id');
    }


}
