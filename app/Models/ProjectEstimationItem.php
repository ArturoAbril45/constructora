<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEstimationItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function estimation()
    {
        return $this->belongsTo(ProjectEstimation::class, 'estimation_id');
    }

    public function activity()
    {
        return $this->belongsTo(ProjectActivity::class, 'activity_id');
    }
}
