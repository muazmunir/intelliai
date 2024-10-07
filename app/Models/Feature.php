<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'list_items',
        'image_path',
        'order',
    ];

    /**
     * Get the list items as an array.
     */
    public function getListItemsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Set the list items as JSON.
     */
    public function setListItemsAttribute($value)
    {
        $this->attributes['list_items'] = json_encode($value);
    }
}
