<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends BaseModel
{
    
    use HasFactory, Auditable, SoftDeletes;

    protected $table = 'depertments';

    protected $fillable = [
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'depertment_id');
    }
}
