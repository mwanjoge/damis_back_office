<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','code','phone_code','embassy_id',  'currency',
        'currency_code','synced'
    ];

    public function embassy()
    {
        return $this->belongsTo(Embassy::class, 'country_id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
