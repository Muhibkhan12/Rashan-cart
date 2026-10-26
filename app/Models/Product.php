<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
| products table: id, category_id, name, sku, unit, retail_price, image_path, is_active
| Needs an App\Models\Category model for the categories table (id, name).
*/
class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'unit',
        'retail_price',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'retail_price' => 'decimal:2',
        'is_active'    => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class);
    }
}