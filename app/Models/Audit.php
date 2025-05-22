<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $casts = [
        'new_values' => 'array',
        'old_values' => 'array'
    ];
}
