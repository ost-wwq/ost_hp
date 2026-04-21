<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyConsent extends Model
{
    protected $fillable = [
        'property_id', 'name', 'phone', 'email', 'business_card', 'ad_types',
    ];

    protected $casts = [
        'ad_types' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
