<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Vendor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image_url',
        'address',
        'latitude',
        'longitude'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class, 'vendor_id', 'id');
    }

    public function featuredFoods(): BelongsToMany
    {
        return $this->belongsToMany(Food::class, 'featured_foods', 'vendor_id', 'food_id');
    }
}
