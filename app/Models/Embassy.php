<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embassy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'is_active',
        'synced',
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
