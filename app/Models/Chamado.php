<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enum\Status;
use App\Enum\Priority;
class Chamado extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'user_id',
        'responsavel_id',
        'opening',
        'in_progress',
        'closing',
    ];

    protected $casts = [
        'opening' => 'datetime',
        'closing' => 'datetime',
        'status' => Status::class,
        'priority' => Priority::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class);
    }
}
