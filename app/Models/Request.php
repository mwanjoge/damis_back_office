<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
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
