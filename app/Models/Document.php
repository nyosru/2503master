<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'leed_id',
        'name',
        'url_template',
    ];

    public function leed()
    {
        return $this->belongsTo(LeedRecord::class, 'leed_id');
    }
}
