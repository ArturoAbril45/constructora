<?php

namespace App\Models;

use App\Models\Concerns\BelongsToBranch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPayable extends Model
{
    use HasFactory, BelongsToBranch;

    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function payments()
    {
        return $this->hasMany(AccountPayablePayment::class);
    }

    public function payable()
    {
        return $this->morphTo(__FUNCTION__, 'payable_type', 'payable_id');
    }

    public function getBalanceAttribute()
    {
        return max(0, $this->total_amount - $this->paid_amount);
    }
}
