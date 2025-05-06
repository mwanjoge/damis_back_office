<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    /** @use HasFactory<\Database\Factories\DesignationFactory> */
    use HasFactory;

    protected $fillable = [
        'account_id',
        'name',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
