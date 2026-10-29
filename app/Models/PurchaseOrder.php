<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requisition()
    {
        return $this->belongsTo(ProjectRequisition::class, 'requisition_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function transferFromWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'transfer_from_warehouse_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(fn ($item) => $item->qty * $item->unit_price);
    }
}
