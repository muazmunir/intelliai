<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'icon',
        'title',
        'short_description',
        'long_description',
        'is_featured',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function getIconUrlAttribute()
    {
        if (! empty($this->icon)) {
            return asset('uploads/services/'.$this->icon);
        }

        return 'https://via.placeholder.com/70x70.png/?text=70x70';
    }
}
