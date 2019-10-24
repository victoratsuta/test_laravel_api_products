<?php

namespace App;

use App\Models\Address;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ["name"];
    protected $hidden = ['_lft', '_rgt'];

    public function products() {
        return $this->hasMany(Product::class);
    }

}
