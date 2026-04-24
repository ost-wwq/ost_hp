<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['name', 'kana', 'phone', 'email', 'address', 'note'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
