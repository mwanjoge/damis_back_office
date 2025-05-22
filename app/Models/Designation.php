<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends BaseModel
{
    /** @use HasFactory<\Database\Factories\DesignationFactory> */
    use HasFactory, SoftDeletes;

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
