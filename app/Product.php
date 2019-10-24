<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "description", "image", "category_id"];

    const DEFAULT_IMAGE = 'default.png';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function delete()
    {
        $file = public_path() . '/storage/images/' . $this->image;

        if (file_exists($file) && $this->image !== self::DEFAULT_IMAGE) {
            @unlink($file);
        }
        parent::delete();
    }
}
