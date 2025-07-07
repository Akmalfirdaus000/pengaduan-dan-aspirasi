<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasUuids;

    protected $fillable = [
        'from',
        'to',
        'status',
        'updated_at'
    ];

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }

    public function message(): HasMany {
        return $this->hasMany(ChatText::class, 'chat_id', 'id');
    }
}
