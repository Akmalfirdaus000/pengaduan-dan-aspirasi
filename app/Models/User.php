<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'user_id', 'id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'user_id', 'id');
    }

    public function changes(): HasMany
    {
        return $this->hasMany(ComplaintStatusHistory::class, 'changed_by', 'id');
    }

    public function notify(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function chat_from(): HasMany
    {
        return $this->hasMany(Chat::class, 'from', 'id');
    }

    public function chat_to(): HasMany
    {
        return $this->hasMany(Chat::class, 'to', 'id');
    }

    public function senderText() : HasMany {
        return $this->hasMany(ChatText::class, 'sender_id', 'id');
    }
}
