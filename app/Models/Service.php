<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

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

    public function requests()
    {
        return $this->hasMany(\App\Models\RequestItem::class, 'service_id');
    }

    public function billableItems()
    {
        return $this->morphMany(BillableItem::class, 'billable');
    }
     public function embassy()
    {
        return $this->belongsTo(Embassy::class);
    }

}
