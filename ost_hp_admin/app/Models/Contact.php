<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class)->orderBy('created_at');
    }

    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    public function markAsRead(): void
    {
        if ($this->isUnread()) {
            $this->update(['read_at' => now()]);
        }
    }
}
