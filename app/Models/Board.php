<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'is_paid',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    // Связь с пользователями (многие ко многим)
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role_id');
    }

    // Обратная связь с пользователями через current_board_id
    public function currentUsers()
    {
        return $this->hasMany(User::class, 'current_board_id');
    }


    // Связь с ролью через pivot-таблицу
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    // Связь с записями в таблице board_user (один ко многим)
    public function boardUsers()
    {
        return $this->hasMany(BoardUser::class);
    }


    // Связь с записями в таблице board_user (один ко многим)
    public function columns()
    {
        return $this->hasMany(LeedColumn::class);
    }

    /**
     * конфиг полей для показа в лидах
     * @return HasMany
     */
    public function fieldSettings(): HasMany
    {
        return $this->hasMany(BoardFieldSetting::class);
    }


    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }


}
