<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeedColumnBackgroundColor extends Model
{
    protected $fillable = [
        'name',
        'html_code',
        'tailwind_classes',
        'style_string'
    ];
}
