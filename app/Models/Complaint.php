<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'tyope', // 'pengaduan' or 'aspirasi'
        'status',
        "location",
        "photo"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class, 'complaint_id', 'id');
    }

    public function complaintHistory(): HasMany
    {
        return $this->hasMany(ComplaintStatusHistory::class, 'complaint_id', 'id');
    }

    public function getCategoryAttribute()
    {
        return $this->belongsTo(Category::class)->getResults() ?? new Category(['name' => 'No Category', 'description' => 'No Category']);
    }
}
