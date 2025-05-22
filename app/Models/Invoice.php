<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'invoice_date' => 'datetime',
    ];

    public function generalLineItems()
    {
        return $this->morphMany(GeneralLineItem::class, 'lineable');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
