<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use SoftDeletes, HasUuids;
    protected $fillable = [
        'url', 
        'products_id'
    ];

    public function getUrlAttribute($url) {
        return config('app.url') . Storage::url($url);
    }

    public function product() {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
