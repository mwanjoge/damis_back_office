<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

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
