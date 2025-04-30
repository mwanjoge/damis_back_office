<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'department_id',
        'account_id',
        'designation_id',
        'is_active',
    ];

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }
}
