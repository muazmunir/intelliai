<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value === null ? 'Null' : ['Draft', 'Published'][$value],
        );
    }
}
