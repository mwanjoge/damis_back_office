<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceProvider extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','account_id'
    ];

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    
}
