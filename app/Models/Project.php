<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    protected $casts = [
        'budget_control' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function budgetItems()
    {
        return $this->hasMany(ProjectBudgetItem::class);
    }

    public function activities()
    {
        return $this->hasMany(ProjectActivity::class);
    }

    public function indirectExpenses()
    {
        return $this->hasMany(ProjectIndirectExpense::class);
    }

    public function rentals()
    {
        return $this->hasMany(ProjectRental::class);
    }

    public function subcontracts()
    {
        return $this->hasMany(ProjectSubcontract::class);
    }

    public function estimations()
    {
        return $this->hasMany(ProjectEstimation::class);
    }

    public function requisitions()
    {
        return $this->hasMany(ProjectRequisition::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function pieceworkRequests()
    {
        return $this->hasMany(ProjectPieceworkRequest::class);
    }

    public function procedures()
    {
        return $this->hasMany(ProjectProcedure::class);
    }

    public function tests()
    {
        return $this->hasMany(ProjectTest::class);
    }

    public function logs()
    {
        return $this->hasMany(ProjectLog::class);
    }

    public function galleryImages()
    {
        return $this->hasMany(ProjectGalleryImage::class);
    }

    public function plans()
    {
        return $this->hasMany(ProjectPlan::class);
    }

    public function accountPayables()
    {
        return $this->hasMany(AccountPayable::class);
    }

    public function accountReceivables()
    {
        return $this->hasMany(AccountReceivable::class);
    }

    public function getBudgetSpentAttribute()
    {
        return $this->accountPayables()->sum('paid_amount');
    }

    public function getFinancialProgressAttribute()
    {
        if ((float) $this->budget_total <= 0) {
            return 0;
        }

        return round(($this->accountPayables()->sum('total_amount') / $this->budget_total) * 100, 3);
    }
}
