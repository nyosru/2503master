<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'is_paid',
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


}
