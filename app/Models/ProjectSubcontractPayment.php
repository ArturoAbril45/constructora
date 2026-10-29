<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSubcontractPayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subcontract()
    {
        return $this->belongsTo(ProjectSubcontract::class, 'subcontract_id');
    }
}
