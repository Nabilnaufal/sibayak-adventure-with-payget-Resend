<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }
}
