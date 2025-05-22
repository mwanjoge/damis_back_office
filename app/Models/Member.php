<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends BaseModel
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
}
