<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardColumnTemplate extends Model
{
    //


    protected $fillable = ['board_template_id', 'name', 'description', 'sorting'];

    // Колонка принадлежит одному шаблону доски
    public function boardTemplate()
    {
        return $this->belongsTo(BoardTemplate::class);
    }

}
