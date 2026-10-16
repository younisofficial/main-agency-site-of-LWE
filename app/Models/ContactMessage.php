<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'services', 'plan', 'budget', 'message', 'read_at'];

    protected function casts(): array
    {
        return ['services' => 'array', 'read_at' => 'datetime'];
    }
}
