<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectBudgetItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function getQtyPendingAttribute()
    {
        return max(0, $this->qty_budgeted - $this->qty_consumed);
    }

    public function getPercentPendingAttribute()
    {
        if ((float) $this->qty_budgeted <= 0) {
            return 0;
        }

        return round(($this->qty_pending / $this->qty_budgeted) * 100, 2);
    }
}
