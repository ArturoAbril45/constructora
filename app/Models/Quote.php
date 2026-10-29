<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
