<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
