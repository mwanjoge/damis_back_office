<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillableItem extends BaseModel
{
    use HasFactory, SoftDeletes;

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
        return $this->belongsTo(Embassy::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
