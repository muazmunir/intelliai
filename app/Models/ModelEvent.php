<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content_id',
        'content_type',
        'action',
        'original_attributes',
        'changed_attributes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
