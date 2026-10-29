<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    protected $casts = [
        'successful' => 'boolean',
        'read_at' => 'datetime',
    ];
}
