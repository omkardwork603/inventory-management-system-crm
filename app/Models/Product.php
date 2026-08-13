<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
    'name',
    'product_code',
    'sku',
    'barcode',
    'description',
    'price',
    'cost_price',
    'stock_quantity',
    'minimum_stock',
    'image',
    'category_id',
    'brand_id',
];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function getStatusAttribute(): string
    {
        if ($this->stock_quantity <= 0) {
            return 'Out of Stock';
        }
        if ($this->stock_quantity <= $this->minimum_stock) {
            return 'Low Stock';
        }
        return 'In Stock';
    }
}
