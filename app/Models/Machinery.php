<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machinery extends Model
{
    use HasFactory, BelongsToBranch;

    protected $table = 'machinery';

    protected $guarded = [];

    public function rentals()
    {
        return $this->hasMany(ProjectRental::class);
    }
}
