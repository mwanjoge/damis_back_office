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
        'country_id',
    ];

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'embassy_id');
    }

    public function billableItems()
    {
        return $this->hasMany(BillableItem::class);
    }

    public function requests()
    {
        return $this->hasMany(\App\Models\Request::class, 'embassy_id');
    }
}
