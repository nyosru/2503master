<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardTemplate extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'status', 'price'];

    // Шаблон доски имеет множество колонок
    public function columns()
    {
        return $this->hasMany(BoardColumnTemplate::class);
    }

    // Шаблон доски имеет множество должностей
    public function positions()
    {
        return $this->hasMany(BoardPositionTemplate::class);
    }

    // Один BoardTemplate может иметь много полей (BoardTemplatePolya)
    public function polya()
    {
        return $this->hasMany(BoardTemplatePolya::class);
    }

}
