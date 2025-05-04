<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes, HasUuids, HasFactory;
    protected $fillable = [
        'name'
    ];

    public function products() {
        return $this->hasMany(Product::class, 'product_categories_id', 'id');
    }
}
