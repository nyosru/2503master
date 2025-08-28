<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardPositionTemplate extends Model
{

    protected $fillable = ['board_template_id', 'name', 'description', 'sorting', 'extra_params' ];

    // Должность принадлежит одному шаблону доски
    public function boardTemplate()
    {
        return $this->belongsTo(BoardTemplate::class);
    }
}
