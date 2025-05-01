<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'embassy_id',
        'service_id',
        'service_provider_id',
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    /** @use HasFactory<\Database\Factories\RequestFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_id',
        'service_id',
        'message',
        'status',
    ];
}
