<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    public function attendances()
    {
        return $this->hasMany(ProjectLaborAttendance::class);
    }

    public function pieceworkRequests()
    {
        return $this->hasMany(ProjectPieceworkRequest::class);
    }
}
