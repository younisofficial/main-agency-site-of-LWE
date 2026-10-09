<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'category', 'name', 'best_for', 'price', 'price_max', 'billing',
        'features', 'is_popular', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'price' => 'integer',
            'price_max' => 'integer',
            'is_popular' => 'boolean',
        ];
    }
}
