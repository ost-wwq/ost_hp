<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'property_id',
        'date_from',
        'date_to',
        'sent_to',
        'free_text',
        'consents_count',
        'viewings_count',
        'consents_data',
        'viewings_data',
    ];

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }

    protected $casts = [
        'date_from'     => 'date',
        'date_to'       => 'date',
        'consents_data' => 'array',
        'viewings_data' => 'array',
    ];
}
