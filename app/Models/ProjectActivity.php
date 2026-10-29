<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function pieceworkItems()
    {
        return $this->hasMany(ProjectPieceworkItem::class, 'activity_id');
    }

    public function estimationItems()
    {
        return $this->hasMany(ProjectEstimationItem::class, 'activity_id');
    }

    public function getTotalBudgetAttribute()
    {
        return $this->qty_budgeted * $this->unit_price;
    }
}
