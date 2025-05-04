<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_categories_id',
        'tags',
    ];

    public function product_category() {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id', 'id');
    }

    public function galleries() {
        return $this->hasMany(ProductPhoto::class, 'products_id', 'id');
    }
}
