<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPieceworkItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function request()
    {
        return $this->belongsTo(ProjectPieceworkRequest::class, 'piecework_request_id');
    }

    public function activity()
    {
        return $this->belongsTo(ProjectActivity::class, 'activity_id');
    }
}
