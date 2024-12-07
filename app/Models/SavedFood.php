<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedFood extends Model
{
    protected $fillable = [
        'food_id',
        'user_id',
    ];
}
