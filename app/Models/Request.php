<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'embassy_id',
        'member_id',
        'country_id',
        'type',
        'status',
        'tracking_number',
        'is_approved',
        'is_paid',
        'total_cost',
        'sent_status',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_paid' => 'boolean',
        'total_cost' => 'decimal:2',
        //'id' => 'encrypted'
    ];

    // Relationships
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function embassy()
    {
        return $this->belongsTo(Embassy::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class, 'request_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
