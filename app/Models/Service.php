<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account_id',
    ];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
