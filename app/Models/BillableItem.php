<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillableItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'billable_id',
        'billable_type',
        'price',
        'currency',
        'account_id',
        'embassy_id',
        'country_id',
        'synced',
    ];

    public function billable()
    {
        return $this->morphTo();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function embassy()
    {
        return $this->belongsTo(Empassy::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
