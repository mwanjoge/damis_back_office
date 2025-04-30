<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name',
        'embassy_id',
        'has_depertment',
    ];

    public function emabassy(){
        return $this->belongsTo(Embassy::class);
    }
}
