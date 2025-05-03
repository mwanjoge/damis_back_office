<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'account_id',
        'service_id',
        'certificate_holder_name',
        'certificate_index_number',
        'attachment',
    ];

    public function service() {
        return $this->belongsTo(\App\Models\Service::class, 'service_id');
    }

    public function serviceProvider() {
        return $this->belongsTo(\App\Models\ServiceProvider::class, 'service_provider_id');
    }
}
