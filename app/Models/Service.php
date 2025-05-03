<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_provider_id',
        'synced',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function requestItems()
    {
        return $this->hasMany(RequestItem::class);
    }

    public function billableItems()
    {
        return $this->morphMany(BillableItem::class, 'billable');
    }
}
