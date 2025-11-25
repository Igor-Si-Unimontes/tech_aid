<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'tags',
        'user_id',
    ];
}
