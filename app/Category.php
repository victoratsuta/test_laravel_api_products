<?php

namespace App;

use App\Models\Address;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    public function products() {
        return $this->hasMany(Product::class);
    }

}
