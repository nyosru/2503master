<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeedColumn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'board_id',
        'order',
        // настройки
        'can_move',
        'can_delete',

        'head_type',
        'type_otkaz',
        'can_create',
        'can_accept_contract',
        'can_get',

    ];

    public function records()
    {
        return $this->hasMany(LeedRecord::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'column_role', 'column_id', 'role_id');
    }


    // Связь с доской
    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    /**
     * Получить все макросы, связанные с этой колонкой
     */
//    public function macros(): HasMany
//    {
//        return $this->hasMany(Macros::class, 'column_id');
//    }
    public function macroses()
    {
        return $this->belongsToMany(
            Macros::class,
            'macro_column',
            'column_id',
            'macro_id'
        );
    }


    // Если у вас связь many-to-one (каждая колонка имеет один цвет)
    public function backgroundColor()
    {
        return $this->belongsToMany(
            LeedColumnBackgroundColor::class,
            'leed_column_color_assignments', // имя таблицы связи
            'leed_column_id',
            'background_color_id'
        )->withTimestamps();
    }


    // Если предполагается, что одна колонка имеет ровно один цвет, и таблица связи есть
    public function currentBackgroundColor()
    {
        return $this->backgroundColor()->first();
    }


}
