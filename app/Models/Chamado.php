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
        'opening',
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
}
