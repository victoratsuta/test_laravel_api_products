<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const DEFAULT_IMAGE = 'default.png';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
