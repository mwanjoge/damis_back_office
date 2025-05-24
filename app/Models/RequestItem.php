<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestItem extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'request_id',
        'account_id',
        'service_id',
        'certificate_holder_name',
        'certificate_index_number',
        'attachment',
        'price'
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function serviceProvider() {
        return $this->belongsTo(\App\Models\ServiceProvider::class, 'service_provider_id');
    }
    
    public function request()
    {
        return $this->belongsTo(\App\Models\Request::class);
    }
}
