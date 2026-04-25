<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewingReservation extends Model
{
    protected $fillable = [
        'property_id', 'name', 'phone', 'email', 'companions',
        'business_card', 'business_card_data', 'business_card_mime',
        'reserved_date', 'reserved_time',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
