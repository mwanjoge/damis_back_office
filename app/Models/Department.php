<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Auditable;

class Department extends BaseModel
{
    
    use HasFactory, Auditable;

    protected $table = 'depertments';

    protected $fillable = [
        'name',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'depertment_id');
    }
}
