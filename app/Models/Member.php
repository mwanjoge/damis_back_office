<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'account_id',
        'name',
        'email',
        'phone',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
