<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'colocation_id',
        'email',
        'token',
        'is_accepted',
        'expires_at',
    ];

    protected $casts = [
        'is_accepted' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}