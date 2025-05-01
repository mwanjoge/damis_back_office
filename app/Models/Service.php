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
        'account_id',
        'synced',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
