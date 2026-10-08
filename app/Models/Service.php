<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug', 'title', 'category', 'icon', 'summary', 'description',
        'deliverables', 'timeline', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'deliverables' => 'array',
        ];
    }
}
