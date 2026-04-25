<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyConsent extends Model
{
    protected $fillable = [
        'property_id', 'name', 'phone', 'email',
        'business_card', 'business_card_data', 'business_card_mime',
        'ad_types', 'ad_other_text',
    ];

    protected $casts = [
        'ad_types' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
