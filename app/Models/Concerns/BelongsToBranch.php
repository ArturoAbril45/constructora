<?php

namespace App\Models\Concerns;

use App\Models\Branch;

trait BelongsToBranch
{
    protected static function bootBelongsToBranch(): void
    {
        static::addGlobalScope('branch', function ($query) {
            if ($branchId = session('branch_id')) {
                $query->where($query->getModel()->getTable().'.branch_id', $branchId);
            }
        });

        static::creating(function ($model) {
            if (! $model->branch_id && session('branch_id')) {
                $model->branch_id = session('branch_id');
            }
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
