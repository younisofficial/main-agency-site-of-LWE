<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = [
        'category', 'name', 'best_for', 'price', 'billing',
        'features', 'is_popular', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'price' => 'integer',
            'is_popular' => 'boolean',
        ];
    }
}
