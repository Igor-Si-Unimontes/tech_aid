<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'content',
        'chamado_id',
        'user_id',
    ];
}
