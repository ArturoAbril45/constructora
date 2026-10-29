<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPayablePayment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accountPayable()
    {
        return $this->belongsTo(AccountPayable::class);
    }

    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
