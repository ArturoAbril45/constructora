<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    public function loans()
    {
        return $this->hasMany(ToolLoan::class);
    }
}
