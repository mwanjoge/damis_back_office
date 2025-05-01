<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'embassy_id',
        'has_depertment',
    ];

    public function emabassy()
    {
        return $this->belongsTo(Embassy::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
