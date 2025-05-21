<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'designation_id',
        'depertment_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'is_active',
    ];

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'depertment_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
