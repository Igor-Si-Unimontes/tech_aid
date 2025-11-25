<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    protected $fillable = [
        'comments',
        'rating',
        'chamado_id',
        'user_id',
    ];
}
